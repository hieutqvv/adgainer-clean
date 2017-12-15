<?php

namespace App\Model;

use App\AbstractReportModel;
use App\Http\Controllers\AbstractReportController;
use Auth;

class RepoYdnCampaignReport extends AbstractReportModel
{
    const GROUPED_BY_FIELD_NAME = 'campaignName';
    const PAGE_ID = 'campaignID';

    protected $table = 'repo_ydn_reports';
    public $timestamps = false;

    public function getAllYdnCampaign(
        $accountId = null
    ) {
        $engine = session(static::SESSION_KEY_ENGINE);
        return self::select('campaignID', 'campaignName')
            ->where(
                function ($query) use ($accountId, $engine) {
                    $this->addQueryConditions(
                        $query,
                        session(AbstractReportController::SESSION_KEY_ADGAINER_ID),
                        $engine,
                        $accountId
                    );
                }
            )
            ->groupBy('campaignID', 'campaignName')->get();
    }
}
