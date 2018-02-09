<?php

namespace App\Http\Controllers\RepoYssAdgroupReport;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\AbstractReportController;
use App\Model\RepoYssAdgroupReportCost;
use App\Model\RepoAdwAdgroupReportCost;
use App\Model\RepoYssPrefectureReportCost;
use App\Model\RepoYdnAdgroupReport;

use Illuminate\Contracts\Routing\ResponseFactory;

use Exception;

class RepoYssAdgroupReportController extends AbstractReportController
{
    const GRAPH_COLUMN_NAME = 'graphColumnName';
    const COLUMN_SORT = 'columnSort';
    const SORT = 'sort';
    const ADGROUP_ID = "adgroupID";
    const MEDIA_ID = self::ADGROUP_ID;
    const SUMMARY_REPORT = 'summaryReport';
    const SESSION_KEY_PREFIX = 'adgroupReport.';
    const SESSION_KEY_FIELD_NAME = self::SESSION_KEY_PREFIX . 'fieldName';
    const SESSION_KEY_PAGINATION = self::SESSION_KEY_PREFIX . 'pagination';
    const SESSION_KEY_ALL_FIELD_NAME = self::SESSION_KEY_PREFIX . 'allFieldName';
    const SESSION_KEY_GRAPH_COLUMN_NAME = self::SESSION_KEY_PREFIX . self::GRAPH_COLUMN_NAME;
    const SESSION_KEY_COLUMN_SORT = self::SESSION_KEY_PREFIX . self::COLUMN_SORT;
    const SESSION_KEY_SORT = self::SESSION_KEY_PREFIX . self::SORT;
    const SESSION_KEY_SUMMARY_REPORT = self::SESSION_KEY_PREFIX . self::SUMMARY_REPORT;
    const SESSION_KEY_PREFIX_ROUTE = '/adgroup-report';
    const SESSION_KEY_GROUPED_BY_FIELD = self::SESSION_KEY_PREFIX . 'groupedByField';

    const REPORTS = 'reports';
    const FIELD_NAMES = 'fieldNames';
    const TOTAL_DATA_ARRAY = 'totalDataArray';
    const COLUMNS = 'columns';
    const COLUMNS_FOR_LIVE_SEARCH = 'columnsLiveSearch';
    const KEY_PAGINATION = 'keyPagination';
    const GROUPED_BY_FIELD = 'adgroupName';
    const ADW_GROUPED_BY_FIELD = 'adGroup';
    const PREFIX_ROUTE = 'prefixRoute';
    const PREFECTURE = 'prefecture';
    const SESSION_KEY_OLD_ENGINE = 'oldEngine';
    const SESSION_KEY_OLD_ID = 'oldId';

    const COLUMNS_FOR_FILTER = 'columnsInModal';
    const DEFAULT_COLUMNS = [
        'impressions',
        'clicks',
        'cost',
        'ctr',
        'averageCpc',
        'averagePosition',
        'impressionShare',
        'conversions',
        '[conversionValues]',
        'web_cv',
        'web_cvr',
        'web_cpa',
        '[phoneNumberValues]',
        'call_cv',
        'call_cvr',
        'call_cpa',
        'total_cv',
        'total_cvr',
        'total_cpa'
    ];

    /**
     * @var \App\Model\RepoYssAdgroupReportCost
     */
    protected $model;

    private $isObjectStdClass = true;

    public function __construct(
        ResponseFactory $responseFactory,
        RepoYssAdgroupReportCost $model
    ) {
        $this->middleware('engine');
        parent::__construct($responseFactory, $model);
        $this->model = $model;
    }

    public function index()
    {
        $engine = $this->updateModel();
        session()->put([self::SESSION_KEY_AD_GROUP_ID => null]);
        $defaultColumns = self::DEFAULT_COLUMNS;
        if ($engine === 'yss' || $engine === 'ydn') {
            array_unshift($defaultColumns, self::ADGROUP_ID, self::GROUPED_BY_FIELD);
            if ($engine === 'ydn') {
                $defaultColumns = $this->model->unsetColumns($defaultColumns, ['impressionShare']);
            }
        } elseif ($engine === 'adw') {
            array_unshift($defaultColumns, self::ADW_GROUPED_BY_FIELD, self::ADGROUP_ID);
        }
        if (!session('adgroupReport')) {
            $this->initializeSession($defaultColumns);
        }
        // update group by field's session based on engine's session
        // on changing account
        // when current filter is Devices, Prefectures, Timezone, DayOfWeek to
        // normal report type
        if ($this->checkoutConditionForUpdateColumn($engine)) {
            $this->updateGroupByFieldWhenSessionEngineChange($defaultColumns);
        }

        $this->checkOldId();
        $this->checkoutSessionFieldName();
        return $this->responseFactory->view(
            'yssAdgroupReport.index',
            [
                self::PREFIX_ROUTE => self::SESSION_KEY_PREFIX_ROUTE,
                self::COLUMNS_FOR_LIVE_SEARCH => self::DEFAULT_COLUMNS_GRAPH,
                self::GRAPH_COLUMN_NAME => session(self::SESSION_KEY_GRAPH_COLUMN_NAME)
            ]
        );
    }

    public function getDataForLayouts()
    {
        $this->updateModel();
        $this->updateSpecificModel();

        $dataReports = $this->getDataForTable();
        $totalDataArray = $this->getCalculatedData();
        $summaryReportData = $this->getCalculatedSummaryReport();
        //add more columns higher layer to fieldnames
        $tableColumns = $this->updateTableColumns($dataReports);
        $columns = array_keys((array) $dataReports[0]);
        if (is_object($dataReports[0]) && property_exists($dataReports[0], 'table')) {
            $columns = array_keys($dataReports[0]->getAttributes());
            $this->isObjectStdClass = false;
        }
        $columns = $this->removeUnnecessaryFields($columns);
        session([self::SESSION_KEY_ALL_FIELD_NAME => $columns]);
        $summaryReportLayout = view(
            'layouts.summary_report',
            [
                self::SUMMARY_REPORT => $summaryReportData
            ]
        )->render();
        $tableDataLayout = view(
            'layouts.table_data',
            [
                self::REPORTS => $dataReports,
                self::FIELD_NAMES => $columns,
                self::COLUMN_SORT => session(self::SESSION_KEY_COLUMN_SORT),
                self::SORT => session(self::SESSION_KEY_SORT),
                self::TOTAL_DATA_ARRAY => $totalDataArray,
                'groupedByField' => session(self::SESSION_KEY_GROUPED_BY_FIELD),
                'isObjectStdClass' => $this->isObjectStdClass,
            ]
        )->render();
        $fieldsOnModal = view(
            'layouts.fields_on_modal',
            [
                self::COLUMNS_FOR_FILTER => self::DEFAULT_COLUMNS,
                self::FIELD_NAMES => self::DEFAULT_COLUMNS
            ]
        )->render();
        $timePeriodLayout = view('layouts.time-period')
            ->with(self::START_DAY, session(self::SESSION_KEY_START_DAY))
            ->with(self::END_DAY, session(self::SESSION_KEY_END_DAY))
            ->with(self::TIME_PERIOD_TITLE, session(self::SESSION_KEY_TIME_PERIOD_TITLE))
            ->render();
        $statusLayout = view('layouts.status-title')
            ->with(self::STATUS_TITLE, session(self::SESSION_KEY_STATUS_TITLE))
            ->render();
        $keyPagination = view(
            'layouts.key_pagination_per_page',
            [
                self::KEY_PAGINATION => session(self::SESSION_KEY_PAGINATION)
            ]
        )->render();

        return $this->responseFactory->json(
            [
                'summaryReportLayout' => $summaryReportLayout,
                'tableDataLayout' => $tableDataLayout,
                'fieldsOnModal' => $fieldsOnModal,
                'timePeriodLayout' => $timePeriodLayout,
                'statusLayout' => $statusLayout,
                'keyPagination' => $keyPagination
            ]
        );
    }

    public function updateTable(Request $request)
    {
        $engine = $this->updateModel();
        $columns = $this->model->getColumnNames();
        if (!session('adgroupReport')) {
            $this->initializeSession($columns);
        }
        $this->updateSessionData($request);

        //after update session, update specific model
        $this->updateSpecificModel();

        $reports = $this->getDataForTable();
        $totalDataArray = $this->getCalculatedData();
        $summaryReportData = $this->getCalculatedSummaryReport();
        $summaryReportLayout = view('layouts.summary_report', [self::SUMMARY_REPORT => $summaryReportData])->render();
        //add more columns higher layer to fieldnames
        $tableColumns = $this->updateTableColumns($reports);
        $columns = array_keys((array) $reports[0]);
        if (is_object($reports[0]) && property_exists($reports[0], 'table')) {
            $columns = array_keys($reports[0]->getAttributes());
            $this->isObjectStdClass = false;
        }
        $columns = $this->removeUnnecessaryFields($columns);
        session([self::SESSION_KEY_ALL_FIELD_NAME => $columns]);
        $tableDataLayout = view(
            'layouts.table_data',
            [
            self::REPORTS => $reports,
            self::FIELD_NAMES => $columns,
            self::COLUMN_SORT => session(self::SESSION_KEY_COLUMN_SORT),
            self::SORT => session(self::SESSION_KEY_SORT),
            self::TOTAL_DATA_ARRAY => $totalDataArray,
            self::PREFIX_ROUTE => self::SESSION_KEY_PREFIX_ROUTE,
            'groupedByField' => session(self::SESSION_KEY_GROUPED_BY_FIELD),
            'isObjectStdClass' => $this->isObjectStdClass
            ]
        )->render();
        // if no data found
        // display no data found message on table
        if ($reports->total() !== 0) {
            $this->displayNoDataFoundMessageOnTable = false;
        }
        return $this->responseFactory->json(
            [
            'summaryReportLayout' => $summaryReportLayout,
            'tableDataLayout' => $tableDataLayout,
            'displayNoDataFoundMessageOnTable' => $this->displayNoDataFoundMessageOnTable
            ]
        );
    }

    public function updateModel()
    {
        $engine = session(self::SESSION_KEY_ENGINE);
        if ($engine === 'yss') {
            $this->model = new RepoYssAdgroupReportCost;
        } elseif ($engine === 'adw') {
            $this->model = new RepoAdwAdgroupReportCost;
        } elseif ($engine === 'ydn') {
            $this->model = new RepoYdnAdgroupReport;
        }
        return $engine;
    }

    private function updateTableColumns(LengthAwarePaginator $dataReports)
    {
        $tableColumns = session(self::SESSION_KEY_FIELD_NAME);
        if (!empty($dataReports[0]->campaignName)) {
            array_unshift($tableColumns, 'campaignName');
        }
        return $tableColumns;
    }

    /* Keep the Devices/Timezone/Prefectures/DayOfWeek after reloading adgroup list
        *Display normal report after:
            * 1. Select Devices/Timezone/Prefectures/DayOfWeek,
            * 2. Transit to campaign list
            * 3. Transit back to adgroup list.
    */
    public function checkOldId()
    {
        if (session(self::SESSION_KEY_OLD_ID) !==  session(static::SESSION_KEY_CAMPAIGNID)
            || session(self::SESSION_KEY_OLD_ENGINE) !== session(self::SESSION_KEY_ENGINE)
        ) {
            $this->updateNormalReport();
            session()->put([self::SESSION_KEY_OLD_ID => session(static::SESSION_KEY_CAMPAIGNID)]);
            session()->put([self::SESSION_KEY_OLD_ENGINE => session(static::SESSION_KEY_ENGINE)]);
        }
    }

    protected function removeUnnecessaryFields($columnTable)
    {
        if (!in_array('cost', session(self::SESSION_KEY_FIELD_NAME))
            && array_search('cost', $columnTable) !== false) {
            unset($columnTable[array_search('cost', $columnTable)]);
        }

        if (!in_array('clicks', session(self::SESSION_KEY_FIELD_NAME))
            && array_search('clicks', $columnTable) !== false) {
            unset($columnTable[array_search('clicks', $columnTable)]);
        }
        return $columnTable;
    }
}
