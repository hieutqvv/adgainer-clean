<?php

use Illuminate\Database\Seeder;
use App\Model\RepoAdwAccountReportCost;

// @codingStandardsIgnoreLine
class RepoAdwAccountReportGenerator extends Seeder
{
    const START_DATE = '2017-12-01 00:00:00';
    const INTERVAL = 'P1D';
    const END_DATE = '2018-03-01 00:00:00';
    const NUMBER_OF_ACCOUNTS = 8;
    const NUMBER_OF_MEDIA_ACCOUNTS = 1;
    const MIN_NUMBER_OF_CAMPAIGNS = 1;
    const MAX_NUMBER_OF_CAMPAIGNS = 3;
    const MIN_NUMBER_OF_REPORTS_PER_DAY_PER_CAMPAIGN = 0;
    const MAX_NUMBER_OF_REPORTS_PER_DAY_PER_CAMPAIGN = 5;
    const MIN_COST = 0;
    const MAX_COST = 1004;
    const MIN_IMPRESSIONS = 0;
    const MAX_IMPRESSIONS = 4096;
    const MIN_IMPRESSIONS_SHARE = 0;
    const MAX_IMPRESSIONS_SHARE = 4096;
    const MIN_CLICKS = 0;
    const MIN_AVERAGE_POSITION = 1;
    const MAX_AVERAGE_POSITION = 20;
    const MIN_CONVERSIONS = 0;
    const MIN_CONV_VALUE = 1000000;
    const MAX_CONV_VALUE = 9999999;
    const NETWORKS = ['CONTENT', 'SEARCH'];
    const DEVICES = ['HIGH_END_MOBILE', 'TABLET', 'DESKTOP', 'UNKNOWN'];

    private function processDay(DateTime $day)
    {
        for ($i = 0; $i <= self::NUMBER_OF_ACCOUNTS; ++$i) {
            $this->processAGAccount($day, $i);
        }
    }

    private function processAGAccount(DateTime $day, $agAccountNumber)
    {
        $numberOfMediaAccounts = 1;

        for ($i = 0; $i < $numberOfMediaAccounts; $i++) {
            $this->processMediaAccount($day, $agAccountNumber, (($agAccountNumber + 1) * 10) + $i);
        }
    }

    private function processMediaAccount(DateTime $day, $agAccountNumber, $mediaAccountNumber)
    {
        $numberOfCampaigns = rand(
            self::MIN_NUMBER_OF_CAMPAIGNS,
            self::MAX_NUMBER_OF_CAMPAIGNS
        );

        for ($i = 0; $i < $numberOfCampaigns + 1; ++$i) {
            $this->processCampaign($day, $agAccountNumber, $mediaAccountNumber, $i);
        }
    }

    private function processCampaign(DateTime $day, $agAccountNumber, $mediaAccountNumber, $campaignNumber)
    {
        $numberOfReports = 2;

        for ($i = 0; $i < $numberOfReports + 1; ++$i) {
            $this->createReport($day, $agAccountNumber, $mediaAccountNumber, $campaignNumber);
        }
    }

    private function createReport(DateTime $day, $agAccountNumber, $mediaAccountNumber, $campaignNumber)
    {
        $costReport = new RepoAdwAccountReportCost;

        if ($agAccountNumber === self::NUMBER_OF_ACCOUNTS) {
            $costReport->account_id = 'dbc087db3467fabd8d46cb04667f5eaa';
            $costReport->campaign_id = (($agAccountNumber + 1) * 10) + $campaignNumber + 1;
        } else {
            $costReport->account_id = $agAccountNumber + 1;
            $costReport->campaign_id = ($costReport->account_id * 10) + $campaignNumber + 1;
        }

        $costReport->account = 'ADW Account'.($mediaAccountNumber + 1);

        $costReport->cost = mt_rand(
            self::MIN_COST,
            self::MAX_COST
        );

        $costReport->impressions = mt_rand(
            self::MIN_IMPRESSIONS,
            self::MAX_IMPRESSIONS
        );

        $costReport->contentImprShare = mt_rand(
            self::MIN_IMPRESSIONS_SHARE,
            self::MAX_IMPRESSIONS_SHARE
        );

        $costReport->searchImprShare = mt_rand(
            self::MIN_IMPRESSIONS_SHARE,
            self::MAX_IMPRESSIONS_SHARE
        );

        $costReport->clicks = mt_rand(
            self::MIN_CLICKS,
            $costReport->impressions
        );

        if ($costReport->clicks === 0) {
            $costReport->avgCPC = 0;
        } else {
            $costReport->avgCPC = $costReport->cost / $costReport->clicks;
        }

        $costReport->avgPosition = mt_rand(
            self::MIN_AVERAGE_POSITION * 100000,
            self::MAX_AVERAGE_POSITION * 100000
        ) / 100000;

        $costReport->conversions = mt_rand(
            self::MIN_CONVERSIONS,
            $costReport->clicks
        );

        if ($costReport->impressions === 0) {
            $costReport->ctr = 0;
        } else {
            $costReport->ctr = ($costReport->clicks / $costReport->impressions) * 100;
        }

        $costReport->valueConv = mt_rand(
            self::MIN_CONV_VALUE,
            self::MAX_CONV_VALUE
        ) / mt_getrandmax();

        $costReport->customerID = $mediaAccountNumber + 1;

        $costReport->network = self::NETWORKS[mt_rand(0, count(self::NETWORKS) - 1)];

        $costReport->device = self::DEVICES[mt_rand(0, count(self::DEVICES) - 1)];

        $costReport->day = $day;

        $costReport->dayOfWeek = $day->format('l');

        $costReport->quarter = $day->format('Y-m-d');

        $costReport->month = $day->format('Y-m-d');

        $costReport->week = $day->format('W');

        $costReport->exeDate = $day->format('Y-m-d');

        $costReport->startDate = $day->format('Y-m-d');

        $costReport->endDate = $day->format('Y-m-d');

        $costReport->hourOfDay = rand(0, 23);

        $costReport->saveOrFail();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = new DateTime(self::START_DATE);
        $interval = new DateInterval(self::INTERVAL);
        $end = new DateTime(self::END_DATE);

        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            $this->processDay($date);
        }
    }
}
