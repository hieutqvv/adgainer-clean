<?php

namespace App\Model;

use App\AbstractReportModel;
use Auth;

class RepoYdnCampaignReport extends AbstractReportModel
{
    const GROUPED_BY_FIELD_NAME = 'campaignName';
    const PAGE_ID = 'campaignID';

    protected $table = 'repo_ydn_reports';
    public $timestamps = false;

    public function getAllYdnCampaign(
        $accountId = null,
        $campaignID = null,
        $adgroupID = null,
        $adID = null
    ) {
        return self::select('campaignID', 'campaignName')
            ->where(
                function ($query) use ($accountId, $campaignID, $adgroupID, $adID) {
                    $this->addQueryConditions(
                        $query,
                        Auth::user()->account_id,
                        $accountId,
                        $campaignID,
                        $adgroupID,
                        $adID
                    );
                }
            )
            ->get();
    }
}