<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\JoinClause;

use App\Model\AbstractYdnReportModel;

class RepoYdnAdgroupPrefecture extends AbstractYdnReportModel
{
    protected $table = 'repo_ydn_reports';

    public $timestamps = false;

    const PAGE_ID = 'adgroupID';

    protected function adjustTemporaryTableColumns(
        $columns,
        $campaignId = null,
        $adGroupId = null
    ) {
        return $this->unsetColumns($columns, [self::PAGE_ID, 'adgroupName']);
    }

    protected function updateTemporaryTableWithConversion(
        $conversionPoints,
        $groupedByField,
        $startDay,
        $endDay,
        $engine,
        $clientId = null,
        $accountId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        $conversionNames = array_values(array_unique($conversionPoints->pluck('conversionName')->toArray()));
        $adgroupIDs = array_unique($conversionPoints->pluck('adgroupID')->toArray());
        foreach ($conversionNames as $key => $conversionName) {
            $queryGetConversion = $this->select(
                DB::raw('SUM(repo_ydn_reports.conversions) AS conversions, '.$groupedByField)
            )->where('conversionName', $conversionName)
                ->whereIn('adgroupID', $adgroupIDs)
                ->where(
                    function (EloquentBuilder $query) use (
                        $startDay,
                        $endDay,
                        $engine,
                        $clientId,
                        $accountId,
                        $campaignId,
                        $adGroupId,
                        $adReportId,
                        $keywordId
                    ) {
                        $this->getCondition(
                            $query,
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
                )->groupBy($groupedByField);

            DB::update(
                'update '.self::TABLE_TEMPORARY.', ('
                .$this->getBindingSql($queryGetConversion).')AS tbl set conversions'.$key.' = tbl.conversions where '
                .self::TABLE_TEMPORARY.'.'.$groupedByField.' = tbl.'.$groupedByField
            );
        }
    }

    protected function updateTemporaryTableWithCallTracking(
        $adGainerCampaigns,
        $groupedByField,
        $startDay,
        $endDay,
        $engine,
        $clientId = null,
        $accountId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        $utmCampaignList = array_unique($adGainerCampaigns->pluck('utm_campaign')->toArray());

        $phoneNumbers = array_values(array_unique($adGainerCampaigns->pluck('phone_number')->toArray()));

        $phoneTimeUseModel = new PhoneTimeUse();
        $phoneTimeUseTableName = $phoneTimeUseModel->getTable();
        foreach ($phoneNumbers as $i => $phoneNumber) {
            $builder = $phoneTimeUseModel->select(
                [
                    DB::raw('count(id) AS id'),
                    'visitor_city_state'
                ]
            )
                ->where('source', '=', $engine)
                ->whereRaw('traffic_type = "AD"')
                ->whereIn('phone_number', $phoneNumbers)
                ->whereIn('utm_campaign', $utmCampaignList)
                ->where(
                    function (EloquentBuilder $query) use ($startDay, $endDay, $phoneTimeUseTableName) {
                        $this->addConditionForDate($query, $phoneTimeUseTableName, $startDay, $endDay);
                    }
                )
                ->groupBy('visitor_city_state');
            DB::update(
                'update '.self::TABLE_TEMPORARY.', ('
                .$this->getBindingSql($builder).') AS tbl set call'.$i.' = tbl.id where '
                .'tbl.visitor_city_state LIKE CONCAT("%",'.self::TABLE_TEMPORARY.'.prefecture," (Japan)")'
            );
        }
    }
}
