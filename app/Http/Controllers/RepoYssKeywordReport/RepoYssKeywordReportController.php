<?php

namespace App\Http\Controllers\RepoYssKeywordReport;

use App\Http\Controllers\AbstractReportController;
use App\Model\RepoYssKeywordReportCost;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

use DateTime;
use Exception;

class RepoYssKeywordReportController extends AbstractReportController
{
    const TIME_PERIOD_TITLE = 'timePeriodTitle';
    const STATUS_TITLE = 'statusTitle';
    const GRAPH_COLUMN_NAME = 'graphColumnName';
    const START_DAY = 'startDay';
    const END_DAY = 'endDay';
    const COLUMN_SORT = 'columnSort';
    const SORT = 'sort';
    const SUMMARY_REPORT = 'summaryReport';
    const SESSION_KEY_PREFIX = 'keywordReport.';
    const SESSION_KEY_FIELD_NAME = self::SESSION_KEY_PREFIX . 'fieldName';
    const SESSION_KEY_TIME_PERIOD_TITLE = self::SESSION_KEY_PREFIX. self::TIME_PERIOD_TITLE;
    const SESSION_KEY_ACCOUNT_STATUS = self::SESSION_KEY_PREFIX . 'accountStatus';
    const SESSION_KEY_STATUS_TITLE = self::SESSION_KEY_PREFIX . self::STATUS_TITLE;
    const SESSION_KEY_START_DAY = self::SESSION_KEY_PREFIX . self::START_DAY;
    const SESSION_KEY_END_DAY = self::SESSION_KEY_PREFIX . self::END_DAY;
    const SESSION_KEY_PAGINATION = self::SESSION_KEY_PREFIX . 'pagination';
    const SESSION_KEY_GRAPH_COLUMN_NAME = self::SESSION_KEY_PREFIX . self::GRAPH_COLUMN_NAME;
    const SESSION_KEY_COLUMN_SORT = self::SESSION_KEY_PREFIX . self::COLUMN_SORT;
    const SESSION_KEY_SORT = self::SESSION_KEY_PREFIX . self::SORT;
    const SESSION_KEY_SUMMARY_REPORT = self::SESSION_KEY_PREFIX . self::SUMMARY_REPORT;
    const SESSION_KEY_PREFIX_ROUTE = '/keyword-report';
    const SESSION_KEY_GROUPED_BY_FIELD = 'keyword';

    const REPORTS = 'reports';
    const FIELD_NAMES = 'fieldNames';
    const TOTAL_DATA_ARRAY = 'totalDataArray';
    const COLUMNS = 'columns';
    const COLUMNS_FOR_LIVE_SEARCH = 'columnsLiveSearch';
    const KEY_PAGINATION = 'keyPagination';
    const GROUPED_BY_FIELD = 'groupedByField';
    const PREFIX_ROUTE = 'prefixRoute';

    const COLUMNS_FOR_FILTER = 'columnsInModal';
    const DEFAULT_COLUMNS = [
        'clicks',
        'cost',
        'impressions',
        'ctr'
        'averageCpc',
        'averagePosition'
    ];

    /** @var \App\Model\RepoYssKeywordReportCost */
    protected $model;

    public function __construct(
        ResponseFactory $responseFactory,
        RepoYssKeywordReportCost $model
    ) {
        parent::__construct($responseFactory, $model);
        $this->model = $model;
    }

    public function index()
    {
        $defaultColumnsWithGroupedField = array_unshift(self::DEFAULT_COLUMNS, self::SESSION_KEY_GROUPED_BY_FIELD);
        if (!session('keywordReport')) {
            $this->initializeSession($defaultColumnsWithGroupedField);
        }
        $dataReports = $this->getDataForTable();
        $totalDataArray = $this->getCalculatedData();
        $summaryReportData = $this->getCalculatedSummaryReport();
        return view('yssKeywordReport.index', [
                self::KEY_PAGINATION => session(self::SESSION_KEY_PAGINATION),
                self::FIELD_NAMES => session(self::SESSION_KEY_FIELD_NAME), // field names which show on top of table
                self::REPORTS => $dataReports, // data that returned from query
                self::COLUMNS => $possibleDisplayItems, // all columns that show up in modal
                self::COLUMN_SORT => session(self::SESSION_KEY_COLUMN_SORT),
                self::SORT => session(self::SESSION_KEY_SORT),
                self::TIME_PERIOD_TITLE => session(self::SESSION_KEY_TIME_PERIOD_TITLE),
                self::STATUS_TITLE => session(self::SESSION_KEY_STATUS_TITLE),
                self::START_DAY => session(self::SESSION_KEY_START_DAY),
                self::END_DAY => session(self::SESSION_KEY_END_DAY),
                // all columns that show columns live search
                self::COLUMNS_FOR_LIVE_SEARCH => self::DEFAULT_COLUMNS,
                self::TOTAL_DATA_ARRAY => $totalDataArray, // total data of each field
                self::COLUMNS_FOR_FILTER => self::DEFAULT_COLUMNS,
                self::SUMMARY_REPORT => $summaryReportData,
                self::PREFIX_ROUTE => self::SESSION_KEY_PREFIX_ROUTE,
                self::GROUPED_BY_FIELD => self::SESSION_KEY_GROUPED_BY_FIELD,
        ]);
    }

    public function displayGraph(Request $request)
    {
        $displayNoDataFoundMessageOnGraph = true;
        $this->updateSessionData($request);
        $timePeriodLayout = view('layouts.time-period')
                        ->with(self::START_DAY, session(self::SESSION_KEY_START_DAY))
                        ->with(self::END_DAY, session(self::SESSION_KEY_END_DAY))
                        ->with(self::TIME_PERIOD_TITLE, session(self::SESSION_KEY_TIME_PERIOD_TITLE))
                        ->render();
        $statusLayout = view('layouts.status-title')
                        ->with(self::STATUS_TITLE, session(self::SESSION_KEY_STATUS_TITLE))
                        ->render();
        $graphColumnLayout = view('layouts.graph-column')
                        ->with(self::GRAPH_COLUMN_NAME, session(self::SESSION_KEY_GRAPH_COLUMN_NAME))
                        ->render();
        try {
            $data = $this->getDataForGraph();
        } catch (Exception $exception) {
            return $this->generateJSONErrorResponse($exception);
        }
        foreach ($data as $value) {
            // if data !== null, display on graph
            // else, display "no data found" image
            if ($value['data'] !== null) {
                $displayNoDataFoundMessageOnGraph = false;
                return $this->responseFactory->json([
                                'data' => $data,
                                'field' => session(self::SESSION_KEY_GRAPH_COLUMN_NAME),
                                'timePeriodLayout' => $timePeriodLayout,
                                'graphColumnLayout' => $graphColumnLayout,
                                'statusLayout' => $statusLayout,
                                'displayNoDataFoundMessageOnGraph' => $displayNoDataFoundMessageOnGraph,
                ]);
            }
            return $this->responseFactory->json([
                            'data' => $data,
                            'field' => session(self::SESSION_KEY_GRAPH_COLUMN_NAME),
                            'timePeriodLayout' => $timePeriodLayout,
                            'graphColumnLayout' => $graphColumnLayout,
                            'statusLayout' => $statusLayout,
                            'displayNoDataFoundMessageOnGraph' => $displayNoDataFoundMessageOnGraph
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function liveSearch(Request $request)
    {
        $result = $this->model->getColumnLiveSearch($request["keywords"]);

        return $this->responseFactory->view(
            'layouts.dropdown_search',
            [self::COLUMNS_FOR_LIVE_SEARCH => $result]
        );
    }
}
