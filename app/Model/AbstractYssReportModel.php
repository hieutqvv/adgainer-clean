<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use App\AbstractReportModel;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;

use DB;

abstract class AbstractYssReportModel extends AbstractTemporaryModel
{
    private $conversionPoints;
    private $adGainerCampaigns;

    protected function getAggregated(array $fieldNames, array $higherLayerSelections = null, $tableName = '')
    {
        return parent::getAggregatedToUpdateTemporatyTable($fieldNames, $higherLayerSelections, $tableName);
    }

    protected function addJoinConditions(JoinClause $join, $joinAlias)
    {
        $join->on($joinAlias.'_campaigns.account_id', '=', $this->table . '.account_id')
            ->on($joinAlias.'_campaigns.campaign_id', '=', $this->table . '.campaign_id')
            ->on(
                function (Builder $builder) use ($joinAlias) {
                    $builder->where(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom1` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom1` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom2` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom2` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom3` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom3` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom4` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom4` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom5` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom5` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom6` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom6` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom7` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom7` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom8` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom8` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom9` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom9` = `{$this->table}`.`adgroupID`");
                        }
                    )->orWhere(
                        function (Builder $builder) use ($joinAlias) {
                            $builder->whereRaw("`".$joinAlias."_campaigns`.`camp_custom10` = 'adgroupid'")
                                ->whereRaw("`".$joinAlias."`.`custom10` = `{$this->table}`.`adgroupID`");
                        }
                    );
                }
            )
            ->on($joinAlias.'.account_id', '=', $this->table . '.account_id')
            ->on($joinAlias.'.campaign_id', '=', $this->table . '.campaign_id')
            ->on($joinAlias.'.utm_campaign', '=', $this->table . '.campaignID')
            ->on(
                DB::raw("STR_TO_DATE(`".$joinAlias."`.`time_of_call`, '%Y-%m-%d')"),
                '=',
                $this->table . '.day'
            )
            ->where($joinAlias.'.source', '=', 'yss')
            ->where($joinAlias.'.traffic_type', '=', 'AD');
    }

    protected function addRawExpressionsConversionPoint(array $expressions, $tableName = "")
    {
        $conversionNames = array_values(array_unique($this->conversionPoints->pluck('conversionName')->toArray()));
        if ($conversionNames !== null) {
            foreach ($conversionNames as $i => $conversionName) {
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    . $tableName
                    . "`.`conversions".$i."`), 0) AS 'YSS "
                    . $conversionName
                    ."<br>"
                    . " CV'"
                );
                $expressions[] = DB::raw(
                    'IFNULL((SUM(`'
                    . $tableName
                    . '`.`conversions'.$i.'`) / SUM(`'
                    . $tableName
                    . "`.`clicks`)) * 100, 0) AS 'YSS "
                    . $conversionName
                    ."<br>"
                    . " CVR'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    . $tableName
                    . '`.`cost`) / SUM(`'
                    . $tableName
                    . "`.`conversions".$i."`), 0) AS 'YSS "
                    . $conversionName
                    ."<br>"
                    . " CPA'"
                );
            }
        }

        return $expressions;
    }

    protected function addRawExpressionsPhoneNumberConversions(array $expressions, $tableName = "")
    {
        if ($this->adGainerCampaigns !== null) {
            foreach ($this->adGainerCampaigns as $i => $campaign) {
                $expressions[] = DB::raw(
                    'IFNULL(`call'
                    . $i
                    . "`, 0) AS 'YSS "
                    . $campaign->campaign_name
                    . "</br>"
                    . $campaign->phone_number
                    . "<br>"
                    . " CV'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(`call'
                    . $i
                    . '` / SUM(`'
                    . $tableName
                    . "`.`clicks`), 0) AS 'YSS "
                    . $campaign->campaign_name
                    . "<br>"
                    . $campaign->phone_number
                    . "<br>"
                    . " CVR'"
                );
                $expressions[] = DB::raw(
                    'IFNULL(SUM(`'
                    . $tableName
                    . '`.`cost`) / `call'
                    . $i
                    . "`, 0) AS 'YSS "
                    . $campaign->campaign_name
                    . "<br>"
                    . $campaign->phone_number
                    . "<br>"
                    . " CPA'"
                );
            }
        }

        return $expressions;
    }

    protected function addRawExpressionTotalCostPerAction(array $expressions, $tableName = "")
    {
        $numberOfCampaigns = count($this->adGainerCampaigns);
        if ($numberOfCampaigns > 0) {
            $expression = 'IFNULL(SUM(`' . $tableName . '`.`cost`) / (SUM(`'
                . $tableName . '`.`conversions`) + ';
            for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
                $expression .= '`call'
                    . $i
                    . '` + ';
            }

            $expression .= '`call'
                . ($numberOfCampaigns - 1)
                . '`), 0) AS total_cpa';

            $expressions[] = DB::raw($expression);
        }
        return $expressions;
    }

    protected function addRawExpressionTotalConversionRate(array $expressions, $tableName = "")
    {
        $numberOfCampaigns = count($this->adGainerCampaigns);
        if ($numberOfCampaigns > 0) {
            $expression = 'IFNULL((SUM(`' . $tableName . '`.`conversions`) + ';
            for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
                $expression .= '`call'
                    . $i
                    . '` + ';
            }

            $expression .= '`call'
                . ($numberOfCampaigns - 1)
                . '`) / '
                . 'SUM(`'
                . $tableName
                . '`.`clicks`), 0) AS total_cvr';

            $expressions[] = DB::raw($expression);
        }
        return $expressions;
    }

    protected function addRawExpressionTotalConversions(array $expressions, $tableName = "")
    {
        $numberOfCampaigns = count($this->adGainerCampaigns);
        if ($numberOfCampaigns > 0) {
            $expression = 'IFNULL(SUM(`' . $tableName . '`.`conversions`) + ';
            for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
                $expression .= '`call'
                    . $i
                    . '` + ';
            }

            $expression .= '`call'
                . ($numberOfCampaigns - 1)
                . '`, 0) AS total_cv';

            $expressions[] = DB::raw($expression);
        }
        return $expressions;
    }

    protected function addRawExpressionCallCostPerAction(array $expressions, $tableName = "")
    {
        $numberOfCampaigns = count($this->adGainerCampaigns);
        if ($numberOfCampaigns > 0) {
            $expression = 'IFNULL(SUM(`' . $tableName . '`.`cost`) / (';
            for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
                $expression .= '`call'
                    . $i
                    . '` + ';
            }

            $expression .= '`call'
                . ($numberOfCampaigns - 1)
                . '`), 0) AS call_cpa';

            $expressions[] = DB::raw($expression);
        }
        return $expressions;
    }

    protected function addRawExpressionCallConversions(array $expressions)
    {
        $numberOfCampaigns = count($this->adGainerCampaigns);
        if ($numberOfCampaigns > 0) {
            $expression = 'IFNULL(';
            for ($i = 0; $i < $numberOfCampaigns - 1; $i++) {
                $expression .= '`call' . $i . '` + ';
            }

            $expression .= '`call' . ($numberOfCampaigns - 1) . '`, 0) AS call_cv';

            $expressions[] = DB::raw($expression);
        }
        return $expressions;
    }

    protected function addRawExpressionCallConversionRate(array $expressions)
    {
        $numberOfCampaigns = count($this->adGainerCampaigns);
        if ($numberOfCampaigns > 0) {
            $expression = 'IFNULL((';
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
        }
        return $expressions;
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
        $adGroupIds = array_unique($this->conversionPoints->pluck('adgroupID')->toArray());
        $campaigns = new Campaign;
        $this->adGainerCampaigns = $campaigns->getAdGainerCampaignsWithPhoneNumber(
            $clientId,
            'yss',
            $campaignIDs,
            static::PAGE_ID,
            null,
            $adGroupIds
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
            $columns = $fieldNames;

            if (!in_array(static::PAGE_ID, $columns)) {
                array_unshift($columns, static::PAGE_ID);
            }

            if (static::PAGE_ID !== 'campaignID') {
                $columns  = $this->higherSelectionFields($columns, $campaignId, $adGroupId);
            }
            $this->createTemporaryTable(
                $columns,
                $this->isConv,
                $this->isCallTracking,
                $this->conversionPoints,
                $this->adGainerCampaigns
            );
            $columns = $this->unsetColumns($columns, array_merge(self::UNSET_COLUMNS, self::FIELDS_CALL_TRACKING));

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
            $aggregated = $this->processGetAggregated(
                $fieldNames,
                $groupedByField,
                $campaignId,
                $adGroupId
            );

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

        if ($this->isConv || $this->isCallTracking) {
            $aggregated = $this->processGetAggregated(
                $fieldNames,
                $groupedByField,
                $campaignId,
                $adGroupId
            );
            $builder = DB::table(self::TABLE_TEMPORARY)->select($aggregated);
        }

        return $builder;
    }

    protected function addConditonForConversionName(
        EloquentBuilder $query,
        $account_id = null,
        $accountId = null,
        $campaignId = null,
        $adGroupId = null,
        $keywordId = null
    ) {
        if ($account_id !== null && $accountId !== null) {
            $query->where('account_id', '=', $account_id)
                ->where('accountId', '=', $accountId);
        }
        if ($campaignId !== null) {
            $query->where('campaignID', '=', $campaignId);
        }
        if ($adGroupId !== null) {
            $query->where('adgroupID', '=', $adGroupId);
        }
        if ($keywordId !== null) {
            $query->where('keywordID', '=', $keywordId);
        }
    }

    protected function getAggregatedConversionName($column)
    {
        $arraySelect = ['conversionName'];
        if ($column === 'campaignID') {
            array_unshift($arraySelect, 'campaignID');
        }

        if ($column === 'adgroupID') {
            array_unshift($arraySelect, 'campaignID', 'adgroupID');
        }

        if ($column === 'keywordID') {
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
