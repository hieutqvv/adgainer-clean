<?php

namespace App\Model;

use App\AbstractReportModel;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

abstract class AbstractAdwModel extends AbstractReportModel
{
    private $conversionPoints;
    private $adGainerCampaigns;

    private $isConv = false;
    private $isCallTracking = false;

    protected function getAggregated(array $fieldNames, array $higherLayerSelections = null, $tableName = "")
    {
        $expressions = parent::getAggregated($fieldNames, $higherLayerSelections, $tableName = "");
        foreach ($fieldNames as $fieldName) {
            switch ($fieldName) {
                case 'criteria.Name':
                    $expressions[] = DB::raw("(`criteria`.`Name`) as prefecture");
                    break;
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
                    $expressions[] = DB::raw("IFNULL(SUM(`{$this->table}`.`conversions`), 0) as web_cv");
                    break;
                case 'web_cvr':
                    $expressions[] = DB::raw("IFNULL((SUM(`{$this->table}`.`conversions`) /
                    SUM(`{$this->table}`.`clicks`)) * 100, 0) as web_cvr");
                    break;
                case 'web_cpa':
                    $expressions[] = DB::raw("IFNULL(SUM(`{$this->table}`.`cost`) /
                    SUM(`{$this->table}`.`conversions`), 0) as web_cpa");
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

    private function addRawExpressionsConversionPoint(array $expressions)
    {
        $conversionNames = array_unique($this->conversionPoints->pluck('conversionName')->toArray());
        if ($conversionNames !== null) {
            foreach ($conversionNames as $i => $conversionName) {
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`conv'
                    . $i
                    . "`.`conversions`), 0) AS 'YDN "
                    . $conversionName
                    . " CV'"
                );
                $expressions[] = DB::raw(
                    'IFNULL((SUM(`conv'
                    . $i
                    . '`.`conversions`) / SUM(`'
                    . $this->getTable()
                    . "`.`clicks`)) * 100, 0) AS 'YDN "
                    . $conversionName
                    . " CVR'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    . $this->getTable()
                    . '`.`cost`) / SUM(`conv'
                    . $i
                    . "`.`conversions`), 0) AS 'YDN "
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
                    'IFNULL(COUNT(`call'
                    . $i
                    . "`.`id`), 0) AS 'YDN "
                    . $campaign->campaign_name
                    . ' '
                    . $campaign->phone_number
                    . " CV'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(COUNT(`call'
                    . $i
                    . '`.`id`) / SUM(`'
                    . $this->table
                    . "`.`clicks`), 0) AS 'YDN "
                    . $campaign->campaign_name
                    . ' '
                    . $campaign->phone_number
                    . " CVR'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    . $this->table
                    . '`.`cost`) / COUNT(`call'
                    . $i
                    . "`.`id`), 0) AS 'YDN "
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
            $expression .= 'COUNT(`call' . $i . '`.`id`) + ';
        }

        $expression .= 'COUNT(`call' . ($numberOfCampaigns - 1) . '`.`id`), 0) AS call_cv';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionCallConversionRate(array $expressions)
    {
        $expression = 'IFNULL((';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= 'COUNT(`call'
                . $i
                . "`.`id`) + ";
        }

        $expression .= 'COUNT(`call'
            . ($numberOfCampaigns - 1)
            . '`.`id`)) / '
            . $numberOfCampaigns
            . ', 0) AS call_cvr';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionCallCostPerAction(array $expressions)
    {
        $expression = 'IFNULL(SUM(`' . $this->table . '`.`cost`) / (';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= 'COUNT(`call'
                . $i
                . '`.`id`) + ';
        }

        $expression .= 'COUNT(`call'
            . ($numberOfCampaigns - 1)
            . '`.`id`)), 0) AS call_cpa';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionTotalConversions(array $expressions)
    {
        $expression = 'IFNULL(SUM(`' . $this->table . '`.`conversions`) + ';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= 'COUNT(`call'
                . $i
                . '`.`id`) + ';
        }

        $expression .= 'COUNT(`call'
            . ($numberOfCampaigns - 1)
            . '`.`id`), 0) AS total_cv';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionTotalConversionRate(array $expressions)
    {
        $expression = 'IFNULL((SUM(`' . $this->table . '`.`conversions`) + ';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= 'COUNT(`call'
                . $i
                . '`.`id`) + ';
        }

        $expression .= 'COUNT(`call'
            . ($numberOfCampaigns - 1)
            . '`.`id`)) / '
            . 'SUM(`'
            . $this->table
            . '`.`clicks`), 0) AS total_cvr';

        $expressions[] = DB::raw($expression);

        return $expressions;
    }

    private function addRawExpressionTotalCostPerAction(array $expressions)
    {
        $expression = 'IFNULL(SUM(`' . $this->table . '`.`cost`) / (SUM(`' . $this->table . '`.`conversions`) + ';
        $numberOfCampaigns = count($this->adGainerCampaigns);
        for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
            $expression .= 'COUNT(`call'
                . $i
                . '`.`id`) + ';
        }

        $expression .= 'COUNT(`call'
            . ($numberOfCampaigns - 1)
            . '`.`id`)), 0) AS total_cpa';

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
            $columns = $this->unsetColumns($fieldNames, array_merge(self::UNSET_COLUMNS, self::FIELDS_CALL_TRACKING));

            if (!in_array(static::PAGE_ID, $columns)) {
                array_unshift($columns, static::PAGE_ID);
            }

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

            $aggregated = $this->processGetAggregated($fieldNames, $groupedByField, $campaignId, $adGroupId);
            $builder = DB::table(self::TABLE_TEMPORARY)
                ->select($aggregated)
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

        $this->addJoin($builder, $this->conversionPoints, $this->adGainerCampaigns);

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
}
