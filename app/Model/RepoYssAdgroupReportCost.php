<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RepoYssAdgroupReportCost extends AbstractReportModel
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'repo_yss_adgroup_report_cost';

    /**
     * @param string[] $fieldNames
     * @param string   $accountStatus
     * @param string   $startDay
     * @param string   $endDay
     * @param int      $pagination
     * @param string   $columnSort
     * @param string   $sort
     * @return string[]
     */
    public function getDataForTable(
        array $fieldNames,
        $accountStatus,
        $startDay,
        $endDay,
        $pagination,
        $columnSort,
        $sort
    ) {
    }

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
        $endDay
    ) {
    }
}
