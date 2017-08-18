<?php

namespace App\Http\Controllers\RepoYssAccountReport;

use App\Http\Controllers\AbstractReportController;
use App\RepoYssAccountReport;
use DateTime;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Classes\FormatIdentifier;

class RepoYssAccountReportController extends AbstractReportController
{
    const SESSION_KEY_PREFIX = 'accountReport.';
    const SESSION_KEY_FIELD_NAME = self::SESSION_KEY_PREFIX . 'fieldName';
    const SESSION_KEY_ACCOUNT_STATUS = self::SESSION_KEY_PREFIX . 'accountStatus';
    const SESSION_KEY_START_DAY = self::SESSION_KEY_PREFIX . 'startDay';
    const SESSION_KEY_END_DAY = self::SESSION_KEY_PREFIX . 'endDay';
    const SESSION_KEY_PAGINATION = self::SESSION_KEY_PREFIX . 'pagination';
    const SESSION_KEY_GRAPH_COLUMN_NAME = self::SESSION_KEY_PREFIX . 'graphColumnName';
    const SESSION_KEY_COLUMN_SORT = self::SESSION_KEY_PREFIX . 'columnSort';
    const SESSION_KEY_SORT = self::SESSION_KEY_PREFIX . 'sort';

    /**
     * @param RepoYssAccountReport $model
     */
    public function __construct(
        ResponseFactory $responseFactory,
        FormatIdentifier $formatIdentifier,
        RepoYssAccountReport $model
    ) {
        parent::__construct($responseFactory, $formatIdentifier, $model);
    }

    /**
     * @return index view
     */
    public function index()
    {
        $columns = $this->model->getColumnNames();
        //unset account_id from all $columns
        if (($key = array_search('account_id', $columns)) !== false) {
            unset($columns[$key]);
        }
        // initialize session for table with fieldName,
        // status, start and end date, pagination

        if (!session('accountReport')) {
            $today = new DateTime();
            $startDay = $today->format('Y-m-d');
            $endDay = $today->modify('-90 days')->format('Y-m-d');
            session([self::SESSION_KEY_FIELD_NAME => $columns]);
            session([self::SESSION_KEY_ACCOUNT_STATUS => '']);
            session([self::SESSION_KEY_START_DAY => $startDay]);
            session([self::SESSION_KEY_END_DAY => $endDay]);
            session([self::SESSION_KEY_PAGINATION => 20]);
            session([self::SESSION_KEY_COLUMN_SORT => 'impressions']);
            session([self::SESSION_KEY_SORT => 'desc']);
        }
        // display data on the table with current session of date, status and column
        $reports = $this->model->getDataForTable(
            session(self::SESSION_KEY_FIELD_NAME),
            session(self::SESSION_KEY_ACCOUNT_STATUS),
            session(self::SESSION_KEY_START_DAY),
            session(self::SESSION_KEY_END_DAY),
            session(self::SESSION_KEY_PAGINATION),
            session(self::SESSION_KEY_COLUMN_SORT),
            session(self::SESSION_KEY_SORT)
        );
        return view('yssAccountReport.index')
                ->with('fieldNames', session(self::SESSION_KEY_FIELD_NAME)) // field names which show on top of table
                ->with('reports', $reports)  // data that returned from query
                ->with('columns', $columns); // all columns that show up in modal
    }

    /**
     * update data by request( date, status, columns) on table
     */
    public function updateTable(Request $request)
    {
        // get fieldName and pagination if available
        if ($request->fieldName === null) {
            session()->put(self::SESSION_KEY_PAGINATION, $request->pagination);
        } else {
            $fieldName = $request->fieldName;
            array_unshift($fieldName, 'account_id');
            session()->put(
                [
                    self::SESSION_KEY_FIELD_NAME => $fieldName,
                    self::SESSION_KEY_PAGINATION => $request->pagination
                ]
            );
        }
        // get startDay and endDay if available
        if ($request->startDay !== null && $request->endDay !== null) {
            session()->put(
                [
                    self::SESSION_KEY_START_DAY => $request->startDay,
                    self::SESSION_KEY_END_DAY => $request->endDay
                ]
            );
        }
        // get status if available
        if ($request->status !== null) {
            session()->put(
                [
                    self::SESSION_KEY_ACCOUNT_STATUS => $request->status,
                ]
            );
        }
        //get column sort and sort by if available
        if ($request->columnSort !== null && session(self::SESSION_KEY_SORT) !== 'asc') {
            session()->put(
                [
                    self::SESSION_KEY_COLUMN_SORT => $request->columnSort,
                    self::SESSION_KEY_SORT => 'asc'
                ]
            );
        } elseif ($request->columnSort !== null && session(self::SESSION_KEY_SORT) !== 'desc') {
            session()->put(
                [
                    self::SESSION_KEY_COLUMN_SORT => $request->columnSort,
                    self::SESSION_KEY_SORT => 'desc'
                ]
            );
        }
        $reports = $this->model->getDataForTable(
            session(self::SESSION_KEY_FIELD_NAME),
            session(self::SESSION_KEY_ACCOUNT_STATUS),
            session(self::SESSION_KEY_START_DAY),
            session(self::SESSION_KEY_END_DAY),
            session(self::SESSION_KEY_PAGINATION),
            session(self::SESSION_KEY_COLUMN_SORT),
            session(self::SESSION_KEY_SORT)
        );
        return view('layouts.table_data')
                ->with('reports', $reports)
                ->with('fieldNames', session(self::SESSION_KEY_FIELD_NAME));
    }

    public function displayDataOnGraph()
    {
        // if get no column name, set selected column click
        if (!session(self::SESSION_KEY_GRAPH_COLUMN_NAME)) {
            session()->put(self::SESSION_KEY_GRAPH_COLUMN_NAME, 'clicks');
        } 
        $data = $this->model
                ->getDataForGraph(
                    session(self::SESSION_KEY_GRAPH_COLUMN_NAME),
                    session(self::SESSION_KEY_ACCOUNT_STATUS),
                    session(self::SESSION_KEY_START_DAY),
                    session(self::SESSION_KEY_END_DAY)
                );
        if ($data->isEmpty()) {
            if (session(self::SESSION_KEY_END_DAY) === session(self::SESSION_KEY_START_DAY)) {
                $data[] = ['day' => session(self::SESSION_KEY_START_DAY), 'data' => 0];
            } else {
                $data[] = ['day' => session(self::SESSION_KEY_END_DAY), 'data' => 0];
                $data[] = ['day' => session(self::SESSION_KEY_START_DAY), 'data' => 0];
            }
        }
        return response()->json($data);
    }

    public function updateGraph(Request $request)
    {
        // update session.graphColumnName
        if ($request->graphColumnName !== null) {
            session()->put('accountReport.graphColumnName', $request->graphColumnName);
        }
        // get startDay and endDay if available
        if ($request->startDay !== null && $request->endDay !== null) {
            session()->put(
                [
                    self::SESSION_KEY_START_DAY => $request->startDay,
                    self::SESSION_KEY_END_DAY => $request->endDay
                ]
            );
        }
        // get status if available
        if ($request->status !== null) {
            session()->put(
                [
                    self::SESSION_KEY_ACCOUNT_STATUS => $request->status,
                ]
            );
        }
        $data = $this->model
                ->getDataForGraph(
                    session(self::SESSION_KEY_GRAPH_COLUMN_NAME),
                    session(self::SESSION_KEY_ACCOUNT_STATUS),
                    session(self::SESSION_KEY_START_DAY),
                    session(self::SESSION_KEY_END_DAY)
                );
        if ($data->isEmpty()) {
            if (session(self::SESSION_KEY_END_DAY) === session(self::SESSION_KEY_START_DAY)) {
                $data[] = ['day' => session(self::SESSION_KEY_START_DAY), 'data' => 0];
            } else {
                $data[] = ['day' => session(self::SESSION_KEY_END_DAY), 'data' => 0];
                $data[] = ['day' => session(self::SESSION_KEY_START_DAY), 'data' => 0];
            }
        }

        return response()->json($data);
    }

}
