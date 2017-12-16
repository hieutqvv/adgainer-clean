SELECT
	`keyword_ad`.`account_id`,
	`keyword_ad`.`campaign_id`,
	#`keyword_ad`.`customerID`,
	`keyword_ad`.`campaignID`,
	`keyword_ad`.`adGroupId`,
	SUM(`keyword_ad`.`impressions`) AS impressions,
	SUM(`keyword_ad`.`clicks`) AS clicks,
	SUM(`keyword_ad`.`cost`) AS cost,
	AVG(`keyword_ad`.`ctr`) AS ctr,
	AVG(`keyword_ad`.`avgCPC`) AS avgCPC,
	SUM(`keyword_ad`.`call_tracking`) AS call_tracking,
	SUM(`keyword_ad`.`webcv`) AS webcv,
	SUM(`keyword_ad`.`cv`) AS cv,
	(SUM(`keyword_ad`.`webcv`) / SUM(`keyword_ad`.`clicks`)) * 100 AS cvr,
	SUM(`keyword_ad`.`cost`) / SUM(`keyword_ad`.`cv`) AS cpa,
	AVG(`keyword_ad`.`avgPosition`) AS avgPosition
FROM
	(
		SELECT
			`repo_adw_ad_report_cost`.`account_id`,
			`repo_adw_ad_report_cost`.`campaign_id`,
			#`repo_adw_ad_report_cost`.`customerID`,
			`repo_adw_ad_report_cost`.`campaignID`,
			`repo_adw_ad_report_cost`.`adGroupId`,
			SUM(`repo_adw_ad_report_cost`.`impressions`) AS impressions,
			SUM(`repo_adw_ad_report_cost`.`clicks`) AS clicks,
			SUM(`repo_adw_ad_report_cost`.`cost`) AS cost,
			AVG(`repo_adw_ad_report_cost`.`ctr`) AS ctr,
			AVG(`repo_adw_ad_report_cost`.`avgCPC`) AS avgCPC,
			COUNT(`phone_time_use`.`id`) AS call_tracking,
			SUM(`repo_adw_ad_report_cost`.`conversions`) AS webcv,
			SUM(`repo_adw_ad_report_cost`.`conversions`) + COUNT(`phone_time_use`.`id`) AS cv,
			((SUM(`repo_adw_ad_report_cost`.`conversions`) + COUNT(`phone_time_use`.`id`)) / SUM(`repo_adw_ad_report_cost`.`clicks`)) * 100 AS cvr,
			SUM(`repo_adw_ad_report_cost`.`cost`) / (SUM(`repo_adw_ad_report_cost`.`conversions`) + COUNT(`phone_time_use`.`id`)) AS cpa,
			AVG(`repo_adw_ad_report_cost`.`avgPosition`) AS avgPosition
		FROM
			`repo_adw_ad_report_cost`
				LEFT JOIN (`campaigns`, `phone_time_use`)
				ON
				(
					`campaigns`.`account_id` = `repo_adw_ad_report_cost`.`account_id`
				AND
					`campaigns`.`campaign_id` = `repo_adw_ad_report_cost`.`campaign_id`
				AND
					(
						(
							`campaigns`.`camp_custom1` = 'creative'
						AND
							`phone_time_use`.`custom1` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom2` = 'creative'
						AND
							`phone_time_use`.`custom2` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom3` = 'creative'
						AND
							`phone_time_use`.`custom3` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom4` = 'creative'
						AND
							`phone_time_use`.`custom4` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom5` = 'creative'
						AND
							`phone_time_use`.`custom5` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom6` = 'creative'
						AND
							`phone_time_use`.`custom6` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom7` = 'creative'
						AND
							`phone_time_use`.`custom7` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom8` = 'creative'
						AND
							`phone_time_use`.`custom8` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom9` = 'creative'
						AND
							`phone_time_use`.`custom9` = `repo_adw_ad_report_cost`.`adID`
						)
					OR
						(
							`campaigns`.`camp_custom10` = 'creative'
						AND
							`phone_time_use`.`custom10` = `repo_adw_ad_report_cost`.`adID`
						)
					)
				AND
					`phone_time_use`.`utm_campaign` = `repo_adw_ad_report_cost`.`campaignID`
				AND
					`phone_time_use`.`time_of_call` >= '2017-01-01'
				AND
					`phone_time_use`.`time_of_call` <= '2017-12-01'
				AND
					`phone_time_use`.`source` = 'adw'
				AND
					`phone_time_use`.`traffic_type` = 'AD'
				)
		WHERE
			`repo_adw_ad_report_cost`.`account_id` = 1
		AND
			`repo_adw_ad_report_cost`.`campaign_id` = 11
		#AND
			#`repo_adw_ad_report_cost`.`customerID` = 1
		AND
			`repo_adw_ad_report_cost`.`campaignID` = 11
		AND
			`repo_adw_ad_report_cost`.`day` >= '2017-01-01'
		AND
			`repo_adw_ad_report_cost`.`day` <= '2017-12-01'
		AND
			`repo_adw_ad_report_cost`.`network` = 'CONTENT'
		GROUP BY
			`repo_adw_ad_report_cost`.`account_id`,
			`repo_adw_ad_report_cost`.`campaign_id`,
			#`repo_adw_ad_report_cost`.`customerID`,
			`repo_adw_ad_report_cost`.`campaignID`,
			`repo_adw_ad_report_cost`.`adGroupId`

		UNION

		SELECT
			`repo_adw_adgroup_report_cost`.`account_id`,
			`repo_adw_adgroup_report_cost`.`campaign_id`,
			#`repo_adw_adgroup_report_cost`.`customerID`,
			`repo_adw_adgroup_report_cost`.`campaignID`,
			`repo_adw_adgroup_report_cost`.`adGroupId`,
			SUM(`repo_adw_adgroup_report_cost`.`impressions`) AS impressions,
			SUM(`repo_adw_adgroup_report_cost`.`clicks`) AS clicks,
			SUM(`repo_adw_adgroup_report_cost`.`cost`) AS cost,
			AVG(`repo_adw_adgroup_report_cost`.`ctr`) AS ctr,
			AVG(`repo_adw_adgroup_report_cost`.`avgCPC`) AS avgCPC,
			COUNT(`phone_time_use`.`id`) AS call_tracking,
			SUM(`repo_adw_adgroup_report_cost`.`conversions`) AS webcv,
			SUM(`repo_adw_adgroup_report_cost`.`conversions`) + COUNT(`phone_time_use`.`id`) AS cv,
			((SUM(`repo_adw_adgroup_report_cost`.`conversions`) + COUNT(`phone_time_use`.`id`)) / SUM(`repo_adw_adgroup_report_cost`.`clicks`)) * 100 AS cvr,
			SUM(`repo_adw_adgroup_report_cost`.`cost`) / (SUM(`repo_adw_adgroup_report_cost`.`conversions`) + COUNT(`phone_time_use`.`id`)) AS cpa,
			AVG(`repo_adw_adgroup_report_cost`.`avgPosition`) AS avgPosition
		FROM
			`repo_adw_adgroup_report_cost`
				LEFT JOIN (`campaigns`, `phone_time_use`)
				ON (
						`campaigns`.`account_id` = `repo_adw_adgroup_report_cost`.`account_id`
					AND
						`campaigns`.`campaign_id` = `repo_adw_adgroup_report_cost`.`campaign_id`
					AND
						(
							(
								`campaigns`.`camp_custom1` = 'adgroupid'
							AND
								`phone_time_use`.`custom1` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom2` = 'adgroupid'
							AND
								`phone_time_use`.`custom2` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom3` = 'adgroupid'
							AND
								`phone_time_use`.`custom3` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom4` = 'adgroupid'
							AND
								`phone_time_use`.`custom4` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom5` = 'adgroupid'
							AND
								`phone_time_use`.`custom5` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom6` = 'adgroupid'
							AND
								`phone_time_use`.`custom6` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom7` = 'adgroupid'
							AND
								`phone_time_use`.`custom7` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom8` = 'adgroupid'
							AND
								`phone_time_use`.`custom8` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom9` = 'adgroupid'
							AND
								`phone_time_use`.`custom9` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						OR
							(
								`campaigns`.`camp_custom10` = 'adgroupid'
							AND
								`phone_time_use`.`custom10` = `repo_adw_adgroup_report_cost`.`adGroupId`
							)
						)
					AND
						`phone_time_use`.`utm_campaign` = `repo_adw_adgroup_report_cost`.`campaignID`
					AND
						`phone_time_use`.`time_of_call` >= '2017-01-01'
					AND
						`phone_time_use`.`time_of_call` <= '2017-12-01'
					AND
						`phone_time_use`.`source` = 'adw'
					AND
						`phone_time_use`.`traffic_type` = 'AD'
				)
		WHERE
			`repo_adw_adgroup_report_cost`.`account_id` = 1
		AND
			`repo_adw_adgroup_report_cost`.`campaign_id` = 11
		#AND
			#`repo_adw_adgroup_report_cost`.`customerID` = 1
		AND
			`repo_adw_adgroup_report_cost`.`campaignID` = 11
		AND
			`repo_adw_adgroup_report_cost`.`day` >= '2017-01-01'
		AND
			`repo_adw_adgroup_report_cost`.`day` <= '2017-12-01'
		AND
			`repo_adw_adgroup_report_cost`.`network` = 'SEARCH'
		GROUP BY
			`repo_adw_adgroup_report_cost`.`account_id`,
			`repo_adw_adgroup_report_cost`.`campaign_id`,
			#`repo_adw_adgroup_report_cost`.`customerID`,
			`repo_adw_adgroup_report_cost`.`campaignID`,
			`repo_adw_adgroup_report_cost`.`adGroupId`
	) AS keyword_ad
GROUP BY
	`keyword_ad`.`account_id`,
	`keyword_ad`.`campaign_id`,
	#`keyword_ad`.`customerID`,
	`keyword_ad`.`campaignID`,
	`keyword_ad`.`adGroupId`