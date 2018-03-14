<?php

namespace App\Http\Controllers\RepoYssAccountReport;

use App\Export\Native\NativePHPCsvExporter;
use App\Export\Spout\SpoutExcelExporter;
use App\Http\Controllers\AbstractReportController;
use App\Model\RepoYssAccountReportCost;
use App\Model\RepoYssPrefectureReportCost;
use App\Model\RepoAccountTimezone;
use App\Model\RepoAccountDayOfWeek;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

use DateTime;
use Exception;
use Auth;
use Illuminate\Support\Facades\Lang;

class RepoYssAccountReportController extends AbstractReportController
{
    const COLUMN_SORT = 'columnSort';
    const ACCOUNT_ID = 'account_id';
    const MEDIA_ID = 'accountid';
    const GROUPED_BY_FIELD = 'accountName';
    const PREFIX_ROUTE = 'prefixRoute';
    const SORT = 'sort';
    const GRAPH_COLUMN_NAME = "graphColumnName";
    const SUMMARY_REPORT = "summaryReport";
    const SESSION_KEY_PREFIX = 'accountReport.';
    const SESSION_KEY_FIELD_NAME = self::SESSION_KEY_PREFIX . 'fieldName';
    const SESSION_KEY_ALL_FIELD_NAME = self::SESSION_KEY_PREFIX . 'allFieldName';
    const SESSION_KEY_PAGINATION = self::SESSION_KEY_PREFIX . 'pagination';
    const SESSION_KEY_GRAPH_COLUMN_NAME = self::SESSION_KEY_PREFIX . self::GRAPH_COLUMN_NAME;
    const SESSION_KEY_COLUMN_SORT = self::SESSION_KEY_PREFIX . self::COLUMN_SORT;
    const SESSION_KEY_SORT = self::SESSION_KEY_PREFIX . self::SORT;
    const SESSION_KEY_SUMMARY_REPORT = self::SESSION_KEY_PREFIX . self::SUMMARY_REPORT;
    const SESSION_KEY_PREFIX_ROUTE = '/account_report';
    const SESSION_KEY_GROUPED_BY_FIELD = self::SESSION_KEY_PREFIX . 'groupedByField';

    const REPORTS = 'reports';
    const FIELD_NAMES = 'fieldNames';
    const TOTAL_DATA_ARRAY = 'totalDataArray';
    const COLUMNS = 'columns';
    const COLUMNS_FOR_LIVE_SEARCH = 'columnsLiveSearch';
    const KEY_PAGINATION = 'keyPagination';
    const PREFECTURE = 'prefecture';

    const COLUMNS_FOR_FILTER = 'columnsInModal';
    const DEFAULT_COLUMNS = [
        'impressions',
        'clicks',
        'cost',
        'ctr',
        'averageCpc',
        'averagePosition',
        'dailySpendingLimit',
        'web_cv',
        'web_cvr',
        'web_cpa',
        'call_cv',
        'call_cvr',
        'call_cpa',
        'total_cv',
        'total_cvr',
        'total_cpa'
    ];

    /**
     * @var \App\Model\RepoYssAccountReportCost
     */
    protected $model;

    /**
     * RepoYssAccountReportController constructor.
     *
     * @param ResponseFactory          $responseFactory
     * @param RepoYssAccountReportCost $model
     */
    public function __construct(
        ResponseFactory $responseFactory,
        RepoYssAccountReportCost $model
    ) {
        $this->middleware('checkRoleClient');
        parent::__construct($responseFactory, $model);
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->put([self::SESSION_KEY_OLD_ENGINE => session(self::SESSION_KEY_ENGINE)]);
        session()->forget(self::SESSION_KEY_ENGINE);
        $defaultColumns = self::DEFAULT_COLUMNS;
        array_unshift($defaultColumns, self::GROUPED_BY_FIELD, self::MEDIA_ID);
        
        if (!session('accountReport')) {
            $this->initializeSession($defaultColumns);
        }
        if (!session('accountStatus')) {
            $this->initializeStatusSession();
        }
        if (!session('timePeriodTitle')) {
            $this->initializeTimeRangeSession();
        }

        session([self::SESSION_KEY_ACCOUNT_ID => null]);
        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === self::PREFECTURE) {
            $this->model = new RepoYssPrefectureReportCost;
        }
        $this->checkoutSessionFieldName();
        return $this->responseFactory->view(
            'yssAccountReport.index',
            [
                self::PREFIX_ROUTE => self::SESSION_KEY_PREFIX_ROUTE,
                self::COLUMNS_FOR_LIVE_SEARCH => self::DEFAULT_COLUMNS_GRAPH,
                self::GRAPH_COLUMN_NAME => session(self::SESSION_KEY_GRAPH_COLUMN_NAME)
            ]
        );
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function getDataForLayouts(Request $request)
    {
        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === self::PREFECTURE) {
            $this->model = new RepoYssPrefectureReportCost;
        }
        $dataReports = $this->getDataForTable();
        if (isset($request->page)) {
            $this->updateNumberPage($request->page);
        }
        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === 'hourofday') {
            $this->model = new RepoAccountTimezone;
        }

        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === 'dayOfWeek') {
            $this->model = new RepoAccountDayOfWeek;
        }
        $totalDataArray = $this->getCalculatedData();
        $summaryReportData = $this->getCalculatedSummaryReport();
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
                'isObjectStdClass' => $this->isObjectStdClass,
                self::FIELD_NAMES => session(self::SESSION_KEY_FIELD_NAME),
                self::COLUMN_SORT => session(self::SESSION_KEY_COLUMN_SORT),
                self::SORT => session(self::SESSION_KEY_SORT),
                self::TOTAL_DATA_ARRAY => $totalDataArray,
                'groupedByField' => session(self::SESSION_KEY_GROUPED_BY_FIELD),
            ]
        )->render();
        $fieldsOnModal = view(
            'layouts.fields_on_modal',
            [
                self::COLUMNS_FOR_FILTER => self::DEFAULT_COLUMNS,
                self::FIELD_NAMES => session(self::SESSION_KEY_FIELD_NAME)
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTable(Request $request)
    {
        $columns = $this->model->getColumnNames();
        if (!session('accountReport')) {
            $this->initializeSession($columns);
        }
        $this->updateSessionData($request);

        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === self::PREFECTURE) {
            $this->model = new RepoYssPrefectureReportCost;
        }

        if ($request->specificItem === self::PREFECTURE) {
            session()->put([self::SESSION_KEY_GROUPED_BY_FIELD => self::PREFECTURE]);
            $this->model = new RepoYssPrefectureReportCost;
        }
        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === 'hourofday') {
            $this->model = new RepoAccountTimezone;
        }

        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === 'dayOfWeek') {
            $this->model = new RepoAccountDayOfWeek;
        }

        $reports = $this->getDataForTable();
        if (isset($request->page)) {
            $this->updateNumberPage($request->page);
        }
        $totalDataArray = $this->getCalculatedData();
        $summaryReportData = $this->getCalculatedSummaryReport();
        $summaryReportLayout = view('layouts.summary_report', [self::SUMMARY_REPORT => $summaryReportData])->render();
        $tableDataLayout = view(
            'layouts.table_data',
            [
                self::REPORTS => $reports,
                'isObjectStdClass' => $this->isObjectStdClass,
                self::FIELD_NAMES => session(self::SESSION_KEY_FIELD_NAME),
                self::COLUMN_SORT => session(self::SESSION_KEY_COLUMN_SORT),
                self::SORT => session(self::SESSION_KEY_SORT),
                self::TOTAL_DATA_ARRAY => $totalDataArray,
                self::PREFIX_ROUTE => self::SESSION_KEY_PREFIX_ROUTE,
                'groupedByField' => session(self::SESSION_KEY_GROUPED_BY_FIELD),
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function displayGraph(Request $request)
    {
        $this->updateSessionData($request);
        $column = Lang::get('language.'.str_slug(session(self::SESSION_KEY_GRAPH_COLUMN_NAME)));
        $timePeriodLayout = view('layouts.time-period')
                    ->with(self::START_DAY, session(self::SESSION_KEY_START_DAY))
                    ->with(self::END_DAY, session(self::SESSION_KEY_END_DAY))
                    ->with(self::TIME_PERIOD_TITLE, session(self::SESSION_KEY_TIME_PERIOD_TITLE))
                    ->render();
        $statusLayout = view('layouts.status-title')
                        ->with(self::STATUS_TITLE, session(self::SESSION_KEY_STATUS_TITLE))
                        ->render();
        try {
            $data = $this->getDataForGraph();
        } catch (Exception $exception) {
            return $this->generateJSONErrorResponse($exception);
        }
        foreach ($data as $value) {
            // if data !== null, display on graph
            // else, display "no data found" image
            if (isset($value->data)) {
                $this->displayNoDataFoundMessageOnGraph = false;
            }
        }
        return $this->responseFactory->json(
            [
                'data' => $data,
                'field' => Lang::get('language.'.session(self::SESSION_KEY_GRAPH_COLUMN_NAME)),
                'timePeriodLayout' => $timePeriodLayout,
                'statusLayout' => $statusLayout,
                'displayNoDataFoundMessageOnGraph' => $this->displayNoDataFoundMessageOnGraph,
                'column' => $column,
                'status' => session(static::SESSION_KEY_ACCOUNT_STATUS)
            ]
        );
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function exportToCsv()
    {
        $fieldNames = session()->get(self::SESSION_KEY_FIELD_NAME);
        $fieldNames = $this->model->unsetColumns($fieldNames, [self::MEDIA_ID]);
        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === 'prefecture') {
            $this->model = new RepoYssPrefectureReportCost;
        }
        /** @var $collection \Illuminate\Database\Eloquent\Collection */
        $collection = $this->getDataForTable();
        $aliases = $this->translateFieldNames($fieldNames);
        $exporter = new NativePHPCsvExporter($collection, $fieldNames, $aliases);
        $csvData = $exporter->export();

        return $this->responseFactory->make(
            $csvData,
            200,
            [
                'Content-Type' => 'application/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $exporter->getFileName() . '"',
                'Expires' => 'Mon, 26 Jul 1997 05:00:00 GMT',
                'Last-Modified' => (new DateTime)->format('D, d M Y H:i:s'),
                'Cache-Control' => 'cache, must-revalidate, private',
                'Pragma' => 'public'
            ]
        );
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function exportToExcel()
    {
        $fieldNames = session()->get(self::SESSION_KEY_FIELD_NAME);
        $fieldNames = $this->model->unsetColumns($fieldNames, [self::MEDIA_ID]);
        if (session(self::SESSION_KEY_GROUPED_BY_FIELD) === 'prefecture') {
            $this->model = new RepoYssPrefectureReportCost;
        }
        /** @var $collection \Illuminate\Database\Eloquent\Collection */
        $collection = $this->getDataForTable();

        $aliases = $this->translateFieldNames($fieldNames);

        $exporter = new SpoutExcelExporter($collection, $fieldNames, $aliases);
        $excelData = $exporter->export();

        return $this->responseFactory->make(
            $excelData,
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $exporter->getFileName() . '"',
                'Expires' => 'Mon, 26 Jul 1997 05:00:00 GMT',
                'Last-Modified' => (new DateTime)->format('D, d M Y H:i:s'),
                'Cache-Control' => 'cache, must-revalidate, private',
                'Pragma' => 'public'
            ]
        );
    }

    private function updateTableColumns($dataReports)
    {
        $tableColumns = session(self::SESSION_KEY_FIELD_NAME);
        if (!empty($dataReports[0]->adgroupName)) {
            array_unshift($tableColumns, 'adgroupName');
        }
        if (!empty($dataReports[0]->campaignName)) {
            array_unshift($tableColumns, 'campaignName');
        }
        return $tableColumns;
    }
}
