<?php

namespace App\Model;

use App\AbstractReportModel;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

abstract class AbstractAdwModel extends AbstractTemporaryModel
{
    private $conversionPoints;
    private $adGainerCampaigns;

    private $isConv = false;
    private $isCallTracking = false;

    protected function getAggregatedForTemporary(array $fieldNames, array $higherLayerSelections = null)
    {
        $tableName = null;
        if ($this->isConv || $this->isCallTracking) {
            $tableName = self::TABLE_TEMPORARY;
        }
        $expressions = parent::getAggregated($fieldNames, $higherLayerSelections, $tableName);
        foreach ($fieldNames as $fieldName) {
            switch ($fieldName) {
                case '[conversionValues]':
                    $expressions = $this->addRawExpressionsConversionPoint($expressions);
                    break;
                case '[phoneNumberValues]':
                    $expressions = $this->addRawExpressionsPhoneNumberConversions($expressions);
                    break;
                case 'call_cv':
                    $expressions = $this->addRawExpressionCallConversions($expressions);
                    break;
                case 'call_cvr':
                    $expressions = $this->addRawExpressionCallConversionRate($expressions);
                    break;
                case 'call_cpa':
                    $expressions = $this->addRawExpressionCallCostPerAction($expressions);
                    break;
                case 'web_cv':
                    $expressions[] = DB::raw("IFNULL(SUM(`".self::TABLE_TEMPORARY."`.`conversions`), 0) as web_cv");
                    break;
                case 'web_cvr':
                    $expressions[] = DB::raw("IFNULL((SUM(`".self::TABLE_TEMPORARY."`.`conversions`) /
                    SUM(`".self::TABLE_TEMPORARY."`.`clicks`)) * 100, 0) as web_cvr");
                    break;
                case 'web_cpa':
                    $expressions[] = DB::raw("IFNULL(SUM(`".self::TABLE_TEMPORARY."`.`cost`) /
                    SUM(`".self::TABLE_TEMPORARY."`.`conversions`), 0) as web_cpa");
                    break;
                case 'total_cv':
                    $expressions = $this->addRawExpressionTotalConversions($expressions);
                    break;
                case 'total_cvr':
                    $expressions = $this->addRawExpressionTotalConversionRate($expressions);
                    break;
                case 'total_cpa':
                    $expressions = $this->addRawExpressionTotalCostPerAction($expressions);
                    break;
            }
        }
        return $expressions;
    }

    private function processGetAggregated($fieldNames, $groupedByField, $campaignId, $adGroupId)
    {
        $higherLayerSelections = [];
        if ($groupedByField !== self::DEVICE
            && $groupedByField !== self::HOUR_OF_DAY
            && $groupedByField !== self::DAY_OF_WEEK
            && $groupedByField !== self::PREFECTURE
        ) {
            $higherLayerSelections = $this->higherLayerSelections($campaignId, $adGroupId);
        }

        return $this->getAggregatedForTemporary($fieldNames, $higherLayerSelections);
    }

    private function addRawExpressionsConversionPoint(array $expressions)
    {
        $conversionNames = array_unique($this->conversionPoints->pluck('conversionName')->toArray());
        if ($conversionNames !== null) {
            foreach ($conversionNames as $i => $conversionName) {
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    .self::TABLE_TEMPORARY
                    . "`.`conversions".$i."`), 0) AS 'Adw "
                    . $conversionName
                    . " CV'"
                );
                $expressions[] = DB::raw(
                    'IFNULL((SUM(`'
                    . self::TABLE_TEMPORARY
                    . '`.`conversions'.$i.'`) / SUM(`'
                    . self::TABLE_TEMPORARY
                    . "`.`clicks`)) * 100, 0) AS 'Adw "
                    . $conversionName
                    . " CVR'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    . self::TABLE_TEMPORARY
                    . '`.`cost`) / SUM(`'
                    . self::TABLE_TEMPORARY
                    . "`.`conversions".$i."`), 0) AS 'Adw "
                    . $conversionName
                    . " CPA'"
                );
            }
        }

        return $expressions;
    }

    private function addRawExpressionsPhoneNumberConversions(array $expressions)
    {
        if ($this->adGainerCampaigns !== null) {
            foreach ($this->adGainerCampaigns as $i => $campaign) {
                $expressions[] = DB::raw(
                    'IFNULL(`call'
                    . $i
                    . "`, 0) AS 'Adw "
                    . $campaign->campaign_name
                    . ' '
                    . $campaign->phone_number
                    . " CV'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(`call'
                    . $i
                    . '` / SUM(`'
                    . self::TABLE_TEMPORARY
                    . "`.`clicks`), 0) AS 'Adw "
                    . $campaign->campaign_name
                    . ' '
                    . $campaign->phone_number
                    . " CVR'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    . self::TABLE_TEMPORARY
                    . '`.`cost`) / `call'
                    . $i
                    . "`, 0) AS 'Adw "
                    . $campaign->campaign_name
                    . ' '
                    . $campaign->phone_number
                    . " CPA'"
                );
            }
        }

        return $expressions;
    }

    private function addRawExpressionCallConversions(array $expressions)
    {
        $expression = 'IFNULL(';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= '`call' . $i . '` + ';
        }

        $expression .= '`call' . ($numberOfCampaigns - 1) . '`, 0) AS call_cv';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionCallConversionRate(array $expressions)
    {
        $expression = 'IFNULL((';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= '`call'
                . $i
                . "` + ";
        }

        $expression .= '`call'
            . ($numberOfCampaigns - 1)
            . '`) / '
            . $numberOfCampaigns
            . ', 0) AS call_cvr';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionCallCostPerAction(array $expressions)
    {
        $expression = 'IFNULL(SUM(`' . self::TABLE_TEMPORARY . '`.`cost`) / (';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= '`call'
                . $i
                . '` + ';
        }

        $expression .= '`call'
            . ($numberOfCampaigns - 1)
            . '`), 0) AS call_cpa';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionTotalConversions(array $expressions)
    {
        $expression = 'IFNULL(SUM(`' . self::TABLE_TEMPORARY . '`.`conversions`) + ';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= '`call'
                . $i
                . '` + ';
        }

        $expression .= '`call'
            . ($numberOfCampaigns - 1)
            . '`, 0) AS total_cv';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionTotalConversionRate(array $expressions)
    {
        $expression = 'IFNULL((SUM(`' . self::TABLE_TEMPORARY . '`.`conversions`) + ';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= '`call'
                . $i
                . '` + ';
        }

        $expression .= '`call'
            . ($numberOfCampaigns - 1)
            . '`) / '
            . 'SUM(`'
            . self::TABLE_TEMPORARY
            . '`.`clicks`), 0) AS total_cvr';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionTotalCostPerAction(array $expressions)
    {
        $expression = 'IFNULL(SUM(`' . self::TABLE_TEMPORARY . '`.`cost`) / (SUM(`'
            . self::TABLE_TEMPORARY . '`.`conversions`) + ';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= '`call'
                . $i
                . '` + ';
        }

        $expression .= '`call'
            . ($numberOfCampaigns - 1)
            . '`), 0) AS total_cpa';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    /* TODO: check if we still need it */
    protected function addJoin(EloquentBuilder $builder)
    {
        $builder->leftJoin(
            'phone_time_use',
            function (JoinClause $join) {
                $this->addJoinConditions($join);
            }
        );
    }

    protected function getBuilderForGetDataForTable(
        $engine,
        array $fieldNames,
        $accountStatus,
        $startDay,
        $endDay,
        $columnSort,
        $sort,
        $groupedByField,
        $agencyId = null,
        $accountId = null,
        $clientId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        $this->conversionPoints = $this->getAllDistinctConversionNames(
            $clientId,
            $accountId,
            $campaignId,
            $adGroupId,
            static::PAGE_ID
        );
        $campaignIDs = array_unique($this->conversionPoints->pluck('campaignID')->toArray());
        $adIDs = array_unique($this->conversionPoints->pluck('adID')->toArray());
        $keywordIDs = array_unique($this->conversionPoints->pluck('keywordID')->toArray());
        $campaigns = new Campaign;
        $this->adGainerCampaigns = $campaigns->getAdGainerCampaignsWithPhoneNumber(
            $clientId,
            'adw',
            $campaignIDs,
            static::PAGE_ID,
            $adIDs,
            $keywordIDs
        );

        $fieldNames = $this->checkConditionFieldName($fieldNames);

        $builder = parent::getBuilderForGetDataForTable(
            $engine,
            $fieldNames,
            $accountStatus,
            $startDay,
            $endDay,
            $columnSort,
            $sort,
            $groupedByField,
            $agencyId,
            $accountId,
            $clientId,
            $campaignId,
            $adGroupId,
            $adReportId,
            $keywordId
        );
        if ($this->isConv || $this->isCallTracking) {
            $this->createTemporaryTable(
                $fieldNames,
                $this->isConv,
                $this->isCallTracking,
                $this->conversionPoints,
                $this->adGainerCampaigns
            );
            $columns = $this->unsetColumns(
                $fieldNames,
                array_merge(self::UNSET_COLUMNS, self::FIELDS_CALL_TRACKING)
            );

            if (!in_array(static::PAGE_ID, $columns)) {
                array_unshift($columns, static::PAGE_ID);
            }

            $columns = array_keys($this->updateFieldNames($columns));
            DB::insert('INSERT into '.self::TABLE_TEMPORARY.' ('.implode(', ', $columns).') '
                . $this->getBindingSql($builder));
            if ($this->isConv) {
                $this->updateTemporaryTableWithConversion(
                    $this->conversionPoints,
                    $groupedByField,
                    $startDay,
                    $endDay,
                    $engine,
                    $clientId,
                    $accountId,
                    $campaignId,
                    $adGroupId,
                    $adReportId,
                    $keywordId
                );
            }

            if ($this->isCallTracking) {
                $this->updateTemporaryTableWithCallTracking(
                    $this->adGainerCampaigns,
                    $groupedByField,
                    $startDay,
                    $endDay
                );
            }
            $fieldNames = $this->unsetColumns($fieldNames, ['impressionShare']);
            $aggregated = $this->processGetAggregated($fieldNames, $groupedByField, $campaignId, $adGroupId);
            $builder = DB::table(self::TABLE_TEMPORARY)
                ->select(array_merge($aggregated, [DB::raw('IFNULL(ROUND(impressionShare, 2), 0) AS impressionShare')]))
                ->groupby($groupedByField)
                ->orderBy($columnSort, $sort);
        }

        return $builder;
    }

    protected function getBuilderForCalculateData(
        $engine,
        $fieldNames,
        $accountStatus,
        $startDay,
        $endDay,
        $groupedByField,
        $agencyId = null,
        $accountId = null,
        $clientId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        $builder = parent::getBuilderForCalculateData(
            $engine,
            $fieldNames,
            $accountStatus,
            $startDay,
            $endDay,
            $groupedByField,
            $agencyId,
            $accountId,
            $clientId,
            $campaignId,
            $adGroupId,
            $adReportId,
            $keywordId
        );

        if ($this->isConv || $this->isCallTracking) {
            $fieldNames = $this->unsetColumns($fieldNames, ['impressionShare']);
            $aggregated = $this->processGetAggregated($fieldNames, $groupedByField, $campaignId, $adGroupId);
            $builder = DB::table(self::TABLE_TEMPORARY)->select(
                array_merge(
                    $aggregated,
                    [DB::raw('IFNULL(ROUND(impressionShare, 2), 0) AS impressionShare')]
                )
            );
        }

        return $builder;
    }

    protected function addConditonForConversionName(
        EloquentBuilder $query,
        $account_id = null,
        $accountId = null,
        $campaignId = null,
        $adGroupId = null
    ) {
        if ($account_id !== null && $accountId !== null) {
            $query->where('account_id', '=', $account_id)
                ->where('customerID', '=', $accountId);
        }
    }

    protected function getAggregatedConversionName($column)
    {
        $arraySelect = ['conversionName'];
        if ($column === 'campaignID') {
            array_unshift($arraySelect, 'campaignID');
        } elseif ($column === 'adID') {
            array_unshift($arraySelect, 'campaignID', 'adgroupID', 'adID');
        } elseif ($column === 'keywordID') {
            array_unshift($arraySelect, 'campaignID', 'adgroupID', 'keywordID');
        }
        return $arraySelect;
    }

    private function checkConditionFieldName($fieldNames)
    {
        foreach ($fieldNames as $fieldName) {
            if ($fieldName === '[conversionValues]') {
                $this->isConv = true;
            }

            if (in_array($fieldName, self::FIELDS_CALL_TRACKING)) {
                $this->isCallTracking = true;
            }
        }

        if ($this->isConv || $this->isCallTracking) {
            if (!in_array('cost', $fieldNames)) {
                array_unshift($fieldNames, 'cost');
            }
            if (!in_array('clicks', $fieldNames)) {
                array_unshift($fieldNames, 'clicks');
            }
        }
        return $fieldNames;
    }
}
