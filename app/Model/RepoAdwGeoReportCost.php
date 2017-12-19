<?php

namespace App\Model;

use App\AbstractReportModel;
use Illuminate\Database\Eloquent\Builder;
use DB;

class RepoAdwGeoReportCost extends AbstractReportModel
{
    const GROUPED_BY_FIELD_NAME = 'prefecture';
    const ADW_JOIN_TABLE_NAME = 'criteria';
    const ADW_FIELDS_MAP = [
        //'alias' => 'columns'
        'impressions' => 'impressions',
        'clicks' => 'clicks',
        'cost' => 'cost',
        'ctr' => 'ctr',
        'averageCpc' => 'avgCPC',
        'averagePosition' => 'avgPosition',
        'campaignName' => 'campaign',
        'adgroupName' => 'adGroup'
    ];

    protected $table = 'repo_adw_geo_report_cost';
    public $timestamps = false;

    public function getDataForTable(
        $engine,
        array $fieldNames,
        $accountStatus,
        $startDay,
        $endDay,
        $pagination,
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
        $fieldNames = $this->unsetColumns($fieldNames, ['impressionShare']);
        $adwAggregations = $this->getAggregatedForPrefectureGoogle($fieldNames);
        $paginatedData = RepoAdwGeoReportCost::select($adwAggregations)
            ->join(
                self::ADW_JOIN_TABLE_NAME,
                'repo_adw_geo_report_cost.region',
                '=',
                self::ADW_JOIN_TABLE_NAME . '.CriteriaID'
            )
            ->where(
                function (Builder $query) use ($startDay, $endDay) {
                    $this->addTimeRangeCondition($startDay, $endDay, $query);
                }
            )->where(
                function (Builder $query) use ($clientId) {
                    $query->where('repo_adw_geo_report_cost.account_id', '=', $clientId);
                }
            )
            ->groupBy('criteria.Name')
            ->orderBy($columnSort, $sort);
        if ($accountStatus == self::HIDE_ZERO_STATUS) {
            $paginatedData = $paginatedData->havingRaw(self::SUM_IMPRESSIONS_NOT_EQUAL_ZERO)
                ->paginate($pagination);
        } elseif ($accountStatus == self::SHOW_ZERO_STATUS) {
            $paginatedData = $paginatedData->paginate($pagination);
        }
        return $paginatedData;
    }

    public function calculateData(
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
        $fieldNames = $this->unsetColumns($fieldNames, ['impressionShare']);
        $fieldNames = $this->unsetColumns($fieldNames, [$groupedByField]);
        $adwAggregations = $this->getAggregatedForPrefectureGoogle($fieldNames);
        return RepoAdwGeoReportCost::select($adwAggregations)
            ->join(
                self::ADW_JOIN_TABLE_NAME,
                'repo_adw_geo_report_cost.region',
                '=',
                self::ADW_JOIN_TABLE_NAME . '.CriteriaID'
            )
            ->where(
                function (Builder $query) use ($startDay, $endDay) {
                    $this->addTimeRangeCondition($startDay, $endDay, $query);
                }
            )->where(
                function (Builder $query) use ($clientId) {
                    $query->where('repo_adw_geo_report_cost.account_id', '=', $clientId);
                }
            )
            ->first();
    }

    public function calculateSummaryData(
        $engine,
        $fieldNames,
        $accountStatus,
        $startDay,
        $endDay,
        $agencyId = null,
        $accountId = null,
        $clientId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        $fieldNames = $this->unsetColumns($fieldNames, ['impressionShare']);
        $adwAggregations = $this->getAggregatedForPrefectureGoogle($fieldNames);
        return RepoAdwGeoReportCost::select($adwAggregations)
            ->join(
                self::ADW_JOIN_TABLE_NAME,
                'repo_adw_geo_report_cost.region',
                '=',
                self::ADW_JOIN_TABLE_NAME . '.CriteriaID'
            )
            ->where(
                function (Builder $query) use ($startDay, $endDay) {
                    $this->addTimeRangeCondition($startDay, $endDay, $query);
                }
            )->where(
                function (Builder $query) use ($clientId) {
                    $query->where('repo_adw_geo_report_cost.account_id', '=', $clientId);
                }
            )
            ->first();
    }

    private function getAggregatedForPrefectureGoogle(array $fieldNames)
    {
        $adwAggregations = [];
        $joinTableName = 'criteria';
        $tableName = 'repo_adw_geo_report_cost';
        foreach ($fieldNames as $fieldName) {
            if ($fieldName === 'prefecture') {
                $adwAggregations[] = DB::raw($joinTableName . '.Name as prefecture');
                continue;
            }
            if (in_array($fieldName, static::AVERAGE_FIELDS)) {
                $adwAggregations[] = DB::raw(
                    'ROUND(AVG(' . $tableName . '.' . self::ADW_FIELDS_MAP[$fieldName] . '), 2) AS ' . $fieldName
                );
            } elseif (in_array($fieldName, static::SUM_FIELDS)) {
                if (DB::connection()->getDoctrineColumn($tableName, $fieldName)
                                    ->getType()
                                    ->getName()
                    === self::FIELD_TYPE
                ) {
                    $adwAggregations[] = DB::raw(
                        'ROUND(SUM(' . $tableName . '.' . self::ADW_FIELDS_MAP[$fieldName] . '), 2) AS ' . $fieldName
                    );
                } else {
                    $adwAggregations[] = DB::raw(
                        'SUM( ' . $tableName . '.' . self::ADW_FIELDS_MAP[$fieldName] . ' ) AS ' . $fieldName
                    );
                }
            }
        }
        return $adwAggregations;
    }
}
