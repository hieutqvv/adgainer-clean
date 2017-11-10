<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\AbstractReportModel;
use DateTime;
use Exception;
use Auth;

class RepoYssAdgroupReportCost extends AbstractReportModel
{
    // constant
    const FIELD_TYPE = 'float';
    const GROUPED_BY_FIELD_NAME = 'adgroupName';
    const KEY_ID = "adgroupID";

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'repo_yss_adgroup_report_cost';

    /** @var array */
    private $averageFieldArray = [
        'averageCpc',
        'averagePosition',
        'impressionShare',
        'exactMatchImpressionShare',
        'qualityLostImpressionShare',
        'conversions',
        'convRate',
        'convValue',
        'costPerConv',
        'valuePerConv',
        'mobileBidAdj',
        'desktopBidAdj',
        'tabletBidAdj'
    ];

        /** @var array */
    private $emptyCalculateFieldArray = [
        'quarter',
        'week',
        'network',
        'device',
        'day',
        'dayOfWeek',
        'month',
        'trackingURL',
    ];

    /**
     * @param string $column
     * @param string $accountStatus
     * @param string $startDay
     * @param string $endDay
     * @return \Illuminate\Support\Collection
     */
    public function getDataForGraph(
        $column,
        $accountStatus,
        $startDay,
        $endDay,
        $accountId = null,
        $adgainerId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        try {
            new DateTime($startDay); //NOSONAR
            new DateTime($endDay); //NOSONAR
        } catch (Exception $exception) {
            throw new \InvalidArgumentException($exception->getMessage(), 0, $exception);
        }

        $data = $this->select(
            DB::raw('SUM('.$column.') as data'),
            DB::raw(
                'DATE(day) as day'
            )
        )
        ->where(
            function (Builder $query) use ($startDay, $endDay) {
                $this->addTimeRangeCondition($startDay, $endDay, $query);
            }
        )
        ->where(
            function ($query) use ($adgainerId, $accountId, $campaignId, $adGroupId, $adReportId) {
                $this->addQueryConditions($query, $adgainerId, $accountId, $campaignId, $adGroupId, $adReportId);
            }
        )
        ->groupBy('day');
        if ($accountStatus == self::HIDE_ZERO_STATUS) {
            $data = $data->havingRaw(self::SUM_IMPRESSIONS_NOT_EQUAL_ZERO)
                            ->get();
        } elseif ($accountStatus == self::SHOW_ZERO_STATUS) {
            $data = $data->get();
        }
        return $data;
    }

    public function calculateData(
        $fieldNames,
        $accountStatus,
        $startDay,
        $endDay,
        $groupedByField,
        $accountId = null,
        $adgainerId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        $fieldNames = $this->unsetColumns($fieldNames, [$groupedByField]);
        $arrayCalculate = $this->getAggregated($fieldNames);

        if (empty($arrayCalculate)) {
            return $arrayCalculate;
        }

        $data = $this->select($arrayCalculate)
                ->where(
                    function (Builder $query) use ($startDay, $endDay) {
                        $this->addTimeRangeCondition($startDay, $endDay, $query);
                    }
                )
                ->where(
                    function ($query) use ($adgainerId, $accountId, $campaignId, $adGroupId, $adReportId) {
                        $this->addQueryConditions(
                            $query,
                            $adgainerId,
                            $accountId,
                            $campaignId,
                            $adGroupId,
                            $adReportId
                        );
                    }
                );
        // get aggregated value
        if ($accountStatus == self::HIDE_ZERO_STATUS) {
            $data = $data->havingRaw(self::SUM_IMPRESSIONS_NOT_EQUAL_ZERO)
                            ->first();
        } elseif ($accountStatus == self::SHOW_ZERO_STATUS) {
            $data = $data->first();
        }
        if ($data === null) {
            $data = [];
        } else {
            $data = $data->toArray();
        }
        return $data;
    }

    public function calculateSummaryData(
        $fieldNames,
        $accountStatus,
        $startDay,
        $endDay,
        $groupedByField,
        $accountId = null,
        $adgainerId = null,
        $campaignId = null,
        $adGroupId = null,
        $adReportId = null,
        $keywordId = null
    ) {
        $arrayCalculate = [];
        $tableName = $this->getTable();
        foreach ($fieldNames as $fieldName) {
            if (in_array($fieldName, $this->averageFieldArray)) {
                $arrayCalculate[] = DB::raw(
                    'format(trim(ROUND('.'AVG(' . $fieldName . '),2'.'))+0, 2) AS ' . $fieldName
                );
            } elseif (!in_array($fieldName, $this->emptyCalculateFieldArray)) {
                if (DB::connection()->getDoctrineColumn($tableName, $fieldName)
                    ->getType()
                    ->getName()
                    === self::FIELD_TYPE) {
                    $arrayCalculate[] = DB::raw(
                        'format(trim(ROUND(SUM(' . $fieldName . '), 2))+0, 2) AS ' . $fieldName
                    );
                } else {
                    $arrayCalculate[] = DB::raw('format(SUM(' . $fieldName . '), 0) AS ' . $fieldName);
                }
            }
        }
        $data = $this->select($arrayCalculate)
                    ->where(
                        function (Builder $query) use ($startDay, $endDay) {
                            $this->addTimeRangeCondition($startDay, $endDay, $query);
                        }
                    )
                    ->where(
                        function ($query) use ($adgainerId, $accountId, $campaignId, $adGroupId, $adReportId) {
                            $this->addQueryConditions(
                                $query,
                                $adgainerId,
                                $accountId,
                                $campaignId,
                                $adGroupId,
                                $adReportId
                            );
                        }
                    );
        if ($accountStatus == self::HIDE_ZERO_STATUS) {
            $data = $data->havingRaw(self::SUM_IMPRESSIONS_NOT_EQUAL_ZERO)
                            ->first();
        } elseif ($accountStatus == self::SHOW_ZERO_STATUS) {
            $data = $data->first();
        }
        if ($data === null) {
            $data = [
                'clicks' => 0,
                'impressions' => 0,
                'cost' => 0,
                'averageCpc' => 0,
                'averagePosition' => 0
            ];
        } else {
            $data = $data->toArray();
        }
        return $data;
    }

     /**
     * @param string $keywords
     * @return string[]
     */
    public function getColumnLiveSearch($keywords)
    {
        $searchColumns = DB::select('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = "'. DB::connection()->getDatabaseName() .'" AND TABLE_NAME = "'. $this->table .'"
            AND COLUMN_NAME LIKE '. '"%' . $keywords . '%"');
        $result = [];
        foreach ($searchColumns as $searchColumn) {
            foreach ($searchColumn as $value) {
                $result[] = $value;
            }
        }
        // remove column id, campaign_id ....
        $unsetColumns = [
            'id', 'campaign_id', 'account_id', 'adgroupID', 'network',
            'device', 'day', 'dayOfWeek', 'week',
            'month', 'quarter', 'hourofday', 'adgroupDistributionSettings', 'exeDate',
            'startDate', 'endDate', 'campaignID', 'campaignName', 'adgroupName',
            'mobileBidAdj', 'tabletBidAdj', 'desktopBidAdj',
            'trackingURL', 'customParameters', 'ctr'
        ];

        return $this->unsetColumns($result, $unsetColumns);
    }

    public static function getAllAdgroup()
    {
        $arrAdgroups = [];

        $arrAdgroups['all'] = 'All Adgroup';

        $adgroups = self::select('adgroupID', 'adgroupName')->where('account_id', '=', Auth::user()->account_id)->get();
        if ($adgroups) {
            foreach ($adgroups as $key => $adgroup) {
                $arrAdgroups[$adgroup->adgroupID] = $adgroup->adgroupName;
            }
        }

        return $arrAdgroups;
    }
}
