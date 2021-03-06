<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Eloquent\Builder;

class Campaign extends AbstractTemporaryModel
{
    const ARR_SELECT_FIELDS = [
        'camp_custom1',
        'camp_custom2',
        'camp_custom3',
        'camp_custom4',
        'camp_custom5',
        'camp_custom6',
        'camp_custom7',
        'camp_custom8',
        'camp_custom9',
        'camp_custom10'
    ];

    /** @var bool */
    public $timestamps = false;

    public function getAdGainerCampaignsWithPhoneNumber(
        $account_id,
        $source,
        array $campaignIDs,
        $flag = null,
        array $adIDs = null,
        array $adgroupIds = null
    ) {
        $campaignsTableName = $this->getTable();
        $repoPhoneTimeUseTableName = (new RepoPhoneTimeUse)->getTable();
        if ($flag === 'adID' || $flag === 'adgroupID' || $flag === 'keywordID') {
            $repoPhoneTimeUseTableName = (new PhoneTimeUse)->getTable();
        }

        return $this->distinct()
            ->select([
                $campaignsTableName . '.campaign_id',
                $campaignsTableName . '.campaign_name',
                $repoPhoneTimeUseTableName . '.utm_campaign',
                $repoPhoneTimeUseTableName . '.phone_number'
            ])
            ->join(
                $repoPhoneTimeUseTableName,
                function (JoinClause $join) use ($campaignsTableName, $repoPhoneTimeUseTableName) {
                    $join->on(
                        $campaignsTableName . '.account_id',
                        '=',
                        $repoPhoneTimeUseTableName . '.account_id'
                    )->on(
                        $campaignsTableName . '.campaign_id',
                        '=',
                        $repoPhoneTimeUseTableName . '.campaign_id'
                    );
                }
            )
            ->where(
                function (Builder $query) use (
                    $flag,
                    $campaignsTableName,
                    $repoPhoneTimeUseTableName,
                    $adIDs,
                    $adgroupIds
                ) {
                    if ($flag === 'adID') {
                        $this->addConditionForCampaignsWithPhoneNumber(
                            $query,
                            $campaignsTableName,
                            $repoPhoneTimeUseTableName,
                            $adIDs,
                            'creative'
                        );
                    } elseif ($flag === 'keywordID') {
                        $this->addConditionForCampaignsWithPhoneNumber(
                            $query,
                            $campaignsTableName,
                            $repoPhoneTimeUseTableName,
                            $adgroupIds,
                            'adgroupid'
                        );
                    }
                }
            )
            ->where(
                $campaignsTableName . '.account_id',
                '=',
                $account_id
            )
            ->where(
                $repoPhoneTimeUseTableName . '.source',
                '=',
                $source
            )
            ->whereIn($repoPhoneTimeUseTableName . '.utm_campaign', $campaignIDs)
            ->orderBy('utm_campaign', 'ASC')
            ->get();
    }

    private function addConditionForCampaignsWithPhoneNumber(
        Builder $query,
        $campaignsTableName,
        $repoPhoneTimeUseTableName,
        array $arrayIds,
        $campCustomValue
    ) {
        $query->where(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom1', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom1", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom2', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom2", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom3', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom3", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom4', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom4", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom5', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom5", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom6', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom6", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom7', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom7", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom8', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom8", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom9', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom9", $arrayIds);
            }
        )->orWhere(
            function (Builder $query) use (
                $campaignsTableName,
                $repoPhoneTimeUseTableName,
                $arrayIds,
                $campCustomValue
            ) {
                $query->where($campaignsTableName.'.camp_custom10', $campCustomValue)
                    ->whereIn($repoPhoneTimeUseTableName.".custom10", $arrayIds);
            }
        );
    }

    public function getCustomForPhoneTimeUse($campaignIdAdgainer)
    {
        $campaignId = array_unique($campaignIdAdgainer->pluck('campaign_id')->toArray());
        return $this->select(self::ARR_SELECT_FIELDS)
            ->whereIn('campaign_id', $campaignId)
            ->get();
    }
}
