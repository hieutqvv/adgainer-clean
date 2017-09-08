<?php

namespace Tests\Feature;

use App\Http\Controllers\RepoYssAccountReport\RepoYssAccountReportController;
use App\User;

use Tests\TestCase;

use DateTime;

class TableApiYssAccountReportTest extends TestCase
{
    const ROUTE_ACCOUNT_REPORT = '/account_report';
    const COLUMN_NAME_ACCOUNT_ID = 'account_id';
    const COLUMN_NAME_COST = 'cost';
    const COLUMN_NAME_IMPRESSIONS = 'impressions';
    const COLUMN_NAME_CLICKS = 'clicks';
    const COLUMN_NAME_CTR = 'ctr';
    const COLUMN_NAME_AVERAGE_CPC = 'averageCpc';
    const COLUMN_NAME_AVERAGE_POSITION = 'averagePosition';
    const COLUMN_NAME_INVALID_CLICKS = 'invalidClicks';
    const COLUMN_NAME_INVALID_CLICK_RATE = 'invalidClickRate';
    const COLUMN_NAME_IMPRESSION_SHARE = 'impressionShare';
    const COLUMN_NAME_EXACT_MATCH_IMPRESSION_SHARE = 'exactMatchImpressionShare';
    const COLUMN_NAME_BUDGET_LOST_IMPRESSION_SHARE = 'budgetLostImpressionShare';
    const COLUMN_NAME_QUALITY_LOST_IMRPESSION_SHARE = 'qualityLostImpressionShare';
    const COLUMN_NAME_TRACKING_URL = 'trackingURL';
    const COLUMN_NAME_CONVERSIONS = 'conversions';
    const COLUMN_NAME_CONV_RATE = 'convRate';
    const COLUMN_NAME_CONV_VALUE = 'convValue';
    const COLUMN_NAME_COST_PER_CONV = 'costPerConv';
    const COLUMN_NAME_VALUE_PER_CONV = 'valuePerConv';
    const COLUMN_NAME_ALL_CONV = 'allConv';
    const COLUMN_NAME_ALL_CONV_RATE = 'allConvRate';
    const COLUMN_NAME_ALL_CONV_VALUE = 'allConvValue';
    const COLUMN_NAME_COST_PER_ALL_CONV = 'costPerAllConv';
    const COLUMN_NAME_VALUE_PER_ALL_CONV = 'valuePerAllConv';
    const COLUMN_NAME_NETWORK = 'network';
    const COLUMN_NAME_DEVICE = 'device';
    const COLUMN_NAME_DAY = 'day';
    const COLUMN_NAME_DAY_OF_WEEK = 'dayOfWeek';
    const COLUMN_NAME_QUARTER = 'quarter';
    const COLUMN_NAME_MONTH = 'month';
    const COLUMN_NAME_WEEK = 'week';

    const DEFAULT_FIELDS = [
        1  => self::COLUMN_NAME_ACCOUNT_ID,
        3  => self::COLUMN_NAME_COST,
        4  => self::COLUMN_NAME_IMPRESSIONS,
        5  => self::COLUMN_NAME_CLICKS,
        6  => self::COLUMN_NAME_CTR,
        7  => self::COLUMN_NAME_AVERAGE_CPC,
        8  => self::COLUMN_NAME_AVERAGE_POSITION,
        9  => self::COLUMN_NAME_INVALID_CLICKS,
        10 => self::COLUMN_NAME_INVALID_CLICK_RATE,
        11 => self::COLUMN_NAME_IMPRESSION_SHARE,
        12 => self::COLUMN_NAME_EXACT_MATCH_IMPRESSION_SHARE,
        13 => self::COLUMN_NAME_BUDGET_LOST_IMPRESSION_SHARE,
        14 => self::COLUMN_NAME_QUALITY_LOST_IMRPESSION_SHARE,
        15 => self::COLUMN_NAME_TRACKING_URL,
        16 => self::COLUMN_NAME_CONVERSIONS,
        17 => self::COLUMN_NAME_CONV_RATE,
        18 => self::COLUMN_NAME_CONV_VALUE,
        19 => self::COLUMN_NAME_COST_PER_CONV,
        20 => self::COLUMN_NAME_VALUE_PER_CONV,
        21 => self::COLUMN_NAME_ALL_CONV,
        22 => self::COLUMN_NAME_ALL_CONV_RATE,
        23 => self::COLUMN_NAME_ALL_CONV_VALUE,
        24 => self::COLUMN_NAME_COST_PER_ALL_CONV,
        25 => self::COLUMN_NAME_VALUE_PER_ALL_CONV,
        26 => self::COLUMN_NAME_NETWORK,
        27 => self::COLUMN_NAME_DEVICE,
        28 => self::COLUMN_NAME_DAY,
        29 => self::COLUMN_NAME_DAY_OF_WEEK,
        30 => self::COLUMN_NAME_QUARTER,
        31 => self::COLUMN_NAME_MONTH,
        32 => self::COLUMN_NAME_WEEK
    ];

    const CUSTOM_FIELDS = [
        1  => self::COLUMN_NAME_ACCOUNT_ID,
        3  => self::COLUMN_NAME_COST,
        4  => self::COLUMN_NAME_IMPRESSIONS,
        5  => self::COLUMN_NAME_CLICKS,
        6  => self::COLUMN_NAME_CTR,
        7  => self::COLUMN_NAME_AVERAGE_CPC,
        8  => self::COLUMN_NAME_AVERAGE_POSITION,
        16 => self::COLUMN_NAME_CONVERSIONS,
        17 => self::COLUMN_NAME_CONV_RATE,
        18 => self::COLUMN_NAME_CONV_VALUE,
        19 => self::COLUMN_NAME_COST_PER_CONV,
        20 => self::COLUMN_NAME_VALUE_PER_CONV,
        21 => self::COLUMN_NAME_ALL_CONV,
        22 => self::COLUMN_NAME_ALL_CONV_RATE,
        23 => self::COLUMN_NAME_ALL_CONV_VALUE,
        24 => self::COLUMN_NAME_COST_PER_ALL_CONV,
        25 => self::COLUMN_NAME_VALUE_PER_ALL_CONV,
        26 => self::COLUMN_NAME_NETWORK,
        27 => self::COLUMN_NAME_DEVICE,
        28 => self::COLUMN_NAME_DAY,
        29 => self::COLUMN_NAME_DAY_OF_WEEK,
        30 => self::COLUMN_NAME_QUARTER,
        31 => self::COLUMN_NAME_MONTH,
        32 => self::COLUMN_NAME_WEEK
    ];

    const LIVE_SEARCH_FIELDS = [
        1  => self::COLUMN_NAME_ACCOUNT_ID,
        3  => self::COLUMN_NAME_COST,
        4  => self::COLUMN_NAME_IMPRESSIONS,
        5  => self::COLUMN_NAME_CLICKS,
        6  => self::COLUMN_NAME_CTR,
        7  => self::COLUMN_NAME_AVERAGE_CPC,
        8  => self::COLUMN_NAME_AVERAGE_POSITION,
        9  => self::COLUMN_NAME_INVALID_CLICKS,
        10 => self::COLUMN_NAME_INVALID_CLICK_RATE,
        11 => self::COLUMN_NAME_IMPRESSION_SHARE,
        12 => self::COLUMN_NAME_EXACT_MATCH_IMPRESSION_SHARE,
        13 => self::COLUMN_NAME_BUDGET_LOST_IMPRESSION_SHARE,
        14 => self::COLUMN_NAME_QUALITY_LOST_IMRPESSION_SHARE,
        15 => self::COLUMN_NAME_TRACKING_URL,
        16 => self::COLUMN_NAME_CONVERSIONS,
        17 => self::COLUMN_NAME_CONV_RATE,
        18 => self::COLUMN_NAME_CONV_VALUE,
        19 => self::COLUMN_NAME_COST_PER_CONV,
        20 => self::COLUMN_NAME_VALUE_PER_CONV,
        21 => self::COLUMN_NAME_ALL_CONV,
        22 => self::COLUMN_NAME_ALL_CONV_RATE,
        23 => self::COLUMN_NAME_ALL_CONV_VALUE,
        24 => self::COLUMN_NAME_COST_PER_ALL_CONV,
        25 => self::COLUMN_NAME_VALUE_PER_ALL_CONV
    ];

    const COLUMNS_FOR_FILTER = [
        3 => self::COLUMN_NAME_COST,
        4 => self::COLUMN_NAME_IMPRESSIONS,
        5 => self::COLUMN_NAME_CLICKS,
        6 => self::COLUMN_NAME_CTR,
        7 => self::COLUMN_NAME_AVERAGE_CPC,
        8  => self::COLUMN_NAME_AVERAGE_POSITION,
        9  => self::COLUMN_NAME_INVALID_CLICKS,
        10 => self::COLUMN_NAME_INVALID_CLICK_RATE,
        11 => self::COLUMN_NAME_IMPRESSION_SHARE,
        12 => self::COLUMN_NAME_EXACT_MATCH_IMPRESSION_SHARE,
        13 => self::COLUMN_NAME_BUDGET_LOST_IMPRESSION_SHARE,
        14 => self::COLUMN_NAME_QUALITY_LOST_IMRPESSION_SHARE,
        15 => self::COLUMN_NAME_TRACKING_URL,
        16 => self::COLUMN_NAME_CONVERSIONS,
        17 => self::COLUMN_NAME_CONV_RATE,
        18 => self::COLUMN_NAME_CONV_VALUE,
        19 => self::COLUMN_NAME_COST_PER_CONV,
        20 => self::COLUMN_NAME_VALUE_PER_CONV,
        21 => self::COLUMN_NAME_ALL_CONV,
        22 => self::COLUMN_NAME_ALL_CONV_RATE,
        23 => self::COLUMN_NAME_ALL_CONV_VALUE,
        24 => self::COLUMN_NAME_COST_PER_ALL_CONV,
        25 => self::COLUMN_NAME_VALUE_PER_ALL_CONV,
        26 => self::COLUMN_NAME_NETWORK,
        27 => self::COLUMN_NAME_DEVICE,
        28 => self::COLUMN_NAME_DAY,
        29 => self::COLUMN_NAME_DAY_OF_WEEK,
        30 => self::COLUMN_NAME_QUARTER,
        31 => self::COLUMN_NAME_MONTH,
        32 => self::COLUMN_NAME_WEEK
    ];

    const DEFAULT_STATUS = 'enabled';
    const CUSTOM_STATUS = 'someStatus';
    const DEFAULT_TIME_PERIOD_TITLE = 'Last 90 days';
    const CUSTOM_TIME_PERIOD_TITLE = '10 days';
    const CUSTOM_START_DAY = '2017-01-01';
    const CUSTOM_END_DAY = '2017-02-03';
    const JANUARY_1ST_2017 = '2017-01-01';
    const JANUARY_10TH_2017 = '2017-01-10';
    const DEFAULT_PAGINATION = 20;
    const CUSTOM_PAGINATION = 21;
    const DEFAULT_COLUMN_SORT = self::COLUMN_NAME_IMPRESSIONS;
    const CUSTOM_COLUMN_SORT = 'someColumnName';
    const DEFAULT_SORT = 'desc';
    const CUSTOM_SORT = 'someSortOption';
    const VIEW_PATH = 'yssAccountReport.index';

    /**
     * @return \App\User
     */
    private function getUser()
    {
        return (new User)->find(1)->first();
    }

    public function setUp()
    {
        parent::setUp();
        $this->flushSession();
    }

    public function testRedirectsToLoginRouteWhenNotLoggedIn()
    {
        $response = $this->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertRedirect('/login');
    }

    public function testReturns200StatusWhenLoggedIn()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertStatus(200);
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultColumnsAreStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_FIELD_NAME,
            self::DEFAULT_FIELDS
        );
    }

    public function testWhenSessionDataIsAvailableTheColumnsInTheSessionAreNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::CUSTOM_FIELDS
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_FIELD_NAME,
            self::CUSTOM_FIELDS
        );
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultStatusIsStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS,
            self::DEFAULT_STATUS
        );
    }

    public function testWhenSessionDataIsAvailableTheStatusInTheSessionIsNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::CUSTOM_STATUS
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS,
            self::CUSTOM_STATUS
        );
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultTimePeriodTitleIsStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE,
            self::DEFAULT_TIME_PERIOD_TITLE
        );
    }

    public function testWhenSessionDataIsAvailableTheTimePeriodTitleInTheSessionIsNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE =>
                    self::CUSTOM_TIME_PERIOD_TITLE
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE,
            self::CUSTOM_TIME_PERIOD_TITLE
        );
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultStartDayIsStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $startDay = (new DateTime)->modify('-90 days')->format('Y-m-d');

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_START_DAY,
            $startDay
        );
    }

    public function testWhenSessionDataIsAvailableTheStartDayInTheSessionIsNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::CUSTOM_START_DAY
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_START_DAY,
            self::CUSTOM_START_DAY
        );
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultEndDayIsStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $endDay = (new DateTime)->format('Y-m-d');

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_END_DAY,
            $endDay
        );
    }

    public function testWhenSessionDataIsAvailableTheEndDayInTheSessionIsNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::CUSTOM_END_DAY
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_END_DAY,
            self::CUSTOM_END_DAY
        );
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultPaginationValueIsStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_PAGINATION,
            self::DEFAULT_PAGINATION
        );
    }

    public function testWhenSessionDataIsAvailableThePaginationValueStoredInTheSessionIsNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::CUSTOM_PAGINATION
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_PAGINATION,
            self::CUSTOM_PAGINATION
        );
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultColumnSortValueIsStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT,
            self::DEFAULT_COLUMN_SORT
        );
    }

    public function testWhenSessionDataIsAvailableTheColumnSortValueStoredInTheSessionIsNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::CUSTOM_COLUMN_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT,
            self::CUSTOM_COLUMN_SORT
        );
    }

    public function testWhenNoSessionDataIsAvailableTheDefaultSortValueIsStoredInTheSession()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_SORT,
            self::DEFAULT_SORT
        );
    }

    public function testWhenSessionDataIsAvailableTheSortValueStoredInTheSessionIsNotModified()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertSessionHas(
            RepoYssAccountReportController::SESSION_KEY_SORT,
            self::CUSTOM_SORT
        );
    }

    public function testReturnsCorrectView()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewIs(self::VIEW_PATH);
    }

    public function testViewHasFieldNamesFromSession()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::CUSTOM_FIELDS
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::FIELD_NAMES,
            self::CUSTOM_FIELDS
        );
    }

    public function testViewHasReports()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::DEFAULT_COLUMN_SORT,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::DEFAULT_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::REPORTS
        );
    }

    public function testViewHasColumns()
    {
        $response = $this->actingAs($this->getUser())
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::COLUMNS,
            self::DEFAULT_FIELDS
        );
    }

    public function testViewHasSortColumnFromSession()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::DEFAULT_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::COLUMN_SORT,
            self::COLUMN_NAME_CLICKS
        );
    }

    public function testViewHasSortOrderFromSession()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::SORT,
            self::CUSTOM_SORT
        );
    }

    public function testViewHasTimePeriodTitleFromSession()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::TIME_PERIOD_TITLE,
            self::CUSTOM_TIME_PERIOD_TITLE
        );
    }

    public function testViewHasStartDayFromSession()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::START_DAY,
            self::JANUARY_1ST_2017
        );
    }

    public function testViewHasEndDayFromSession()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::END_DAY,
            self::JANUARY_10TH_2017
        );
    }

    public function testViewHasColumnsForLiveSearch()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::COLUMNS_FOR_LIVE_SEARCH,
            self::LIVE_SEARCH_FIELDS
        );
    }
    public function testViewHasColumnsForFilter()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::COLUMNS_FOR_FILTER,
            self::COLUMNS_FOR_FILTER
        );
    }

    public function testViewHasTotalDataArray()
    {
        $response = $this->actingAs($this->getUser())
            ->withSession([
                RepoYssAccountReportController::SESSION_KEY_FIELD_NAME => self::DEFAULT_FIELDS,
                RepoYssAccountReportController::SESSION_KEY_ACCOUNT_STATUS => self::DEFAULT_STATUS,
                RepoYssAccountReportController::SESSION_KEY_TIME_PERIOD_TITLE => self::CUSTOM_TIME_PERIOD_TITLE,
                RepoYssAccountReportController::SESSION_KEY_START_DAY => self::JANUARY_1ST_2017,
                RepoYssAccountReportController::SESSION_KEY_END_DAY => self::JANUARY_10TH_2017,
                RepoYssAccountReportController::SESSION_KEY_PAGINATION => self::DEFAULT_PAGINATION,
                RepoYssAccountReportController::SESSION_KEY_COLUMN_SORT => self::COLUMN_NAME_CLICKS,
                RepoYssAccountReportController::SESSION_KEY_SORT => self::CUSTOM_SORT
            ])
            ->get(self::ROUTE_ACCOUNT_REPORT);

        $response->assertViewHas(
            RepoYssAccountReportController::TOTAL_DATA_ARRAY,
            [
                self::COLUMN_NAME_COST => '541933',
                self::COLUMN_NAME_IMPRESSIONS => '2171860',
                self::COLUMN_NAME_CLICKS => '4851795',
                self::COLUMN_NAME_CTR => 1815319.778511414,
                self::COLUMN_NAME_AVERAGE_CPC => 20351.20213430856,
                self::COLUMN_NAME_AVERAGE_POSITION => 21115.179336814675,
                self::COLUMN_NAME_INVALID_CLICKS => '48061154',
                self::COLUMN_NAME_INVALID_CLICK_RATE => 22690782.2346613,
                self::COLUMN_NAME_IMPRESSION_SHARE => 22107885.14209085,
                self::COLUMN_NAME_EXACT_MATCH_IMPRESSION_SHARE => 21893539.147720225,
                self::COLUMN_NAME_BUDGET_LOST_IMPRESSION_SHARE => 22023551.61774343,
                self::COLUMN_NAME_QUALITY_LOST_IMRPESSION_SHARE => 21957518.967083298,
                self::COLUMN_NAME_CONVERSIONS => 22304687.329569906,
                self::COLUMN_NAME_CONV_RATE => 21660208.659196503,
                self::COLUMN_NAME_CONV_VALUE => 21929412.859353893,
                self::COLUMN_NAME_COST_PER_CONV => 21461223.893789608,
                self::COLUMN_NAME_VALUE_PER_CONV => 21871477.73641814,
                self::COLUMN_NAME_ALL_CONV => 21811215.915244985,
                self::COLUMN_NAME_ALL_CONV_RATE => 22117956.185311552,
                self::COLUMN_NAME_ALL_CONV_VALUE => 22505433.748617835,
                self::COLUMN_NAME_COST_PER_ALL_CONV => 21916669.870765466,
                self::COLUMN_NAME_VALUE_PER_ALL_CONV => 22237935.55070321
            ]
        );
    }
}
