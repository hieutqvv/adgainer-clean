/* get all unique conversion name of adw ad */
SELECT
  DISTINCT
  `adGroupID`,
  `conversionName`
FROM
  `repo_adw_adgroup_report_conv`
WHERE
  `customerID` = 11
  AND
  `campaignID` = 11;
/*
+---------------------------+
|adGroupID|conversionName   |
|---------------------------|
|1        |Conversion Name 1|
|1        |Conversion Name 2|
|1        |Conversion Name 3|
|2        |Conversion Name 1|
|2        |Conversion Name 2|
|2        |Conversion Name 3|
|3        |Conversion Name 1|
|3        |Conversion Name 2|
|3        |Conversion Name 3|
+---------------------------+
*/

/* get all phone number */
SELECT
  DISTINCT
  `c`.`campaign_id`,
  `c`.`campaign_name`,
  `ptu`.`utm_campaign`,
  `ptu`.`phone_number`
FROM
  `campaigns` as c,
  `phone_time_use` as ptu
WHERE
  `c`.`account_id` = `ptu`.`account_id`
  AND
  `c`.`campaign_id` = `ptu`.`campaign_id`
  AND
  `ptu`.`source` = 'adw'
  AND
  `ptu`.`traffic_type` = 'AD'
  AND
  `ptu`.`account_id` = 1
  AND
  `ptu`.`utm_campaign` = 11;
/*
+----------------------------------------------------+
|campaign_id|campaign_name|utm_campaign|phone_number |
|----------------------------------------------------|
|11         |Campaign Name|11          |+841234567811|
+----------------------------------------------------+
 */

SELECT
  `total`.`account_id`,
  `total`.`customerID`,
  `total`.`campaignID`,
  SUM(`total`.`impressions`) AS impressions,
  SUM(`total`.`clicks`) AS clicks,
  SUM(`total`.`cost`) AS cost,
  AVG(`total`.`ctr`) AS ctr,
  AVG(`total`.`avgCPC`) AS cpc,
  /* add the expressions for the conversionName columns */
  SUM(`conv1`.`conversions`) AS 'Conversion name 1 CV',
  SUM(`conv2`.`conversions`) AS 'Conversion name 2 CV',
  SUM(`conv3`.`conversions`) AS 'Conversion name 3 CV',
  /* add the expressions for the AG campaign_name/phone_number columns */
  COUNT(`call1`.`id`) + COUNT(`ad_call1`.`id`) AS 'Campaign Name +841234567811 CV',
  COUNT(`call1`.`id`) + COUNT(`ad_call1`.`id`) AS call_cv,
  SUM(`total`.`conversions`) AS webcv,
  SUM(`total`.`conversions`) + COUNT(`call1`.`id`) + COUNT(`ad_call1`.`id`) AS cv,
  ((SUM(`total`.`conversions`) + COUNT(`call1`.`id`) + COUNT(`ad_call1`.`id`)) / SUM(`total`.`clicks`)) * 100 AS cvr,
  SUM(`total`.`cost`) / (SUM(`total`.`conversions`) + COUNT(`call1`.`id`) + COUNT(`ad_call1`.`id`)) AS cpa,
  AVG(`total`.`avgPosition`) AS avgPosition
FROM
    `repo_adw_adgroup_report_cost` AS total
  LEFT JOIN `repo_adw_adgroup_report_conv` AS conv1
    ON
      `total`.`account_id` = `conv1`.`account_id`
    AND
      `total`.`customerID` = `conv1`.`customerID`
    AND
      `total`.`day` = `conv1`.`day`
    AND
      `total`.`campaignID` = `conv1`.`campaignID`
    AND
      `total`.`adGroupID` = `conv1`.`adGroupID`
    AND
      `conv1`.`conversionName` = 'Conversion Name 1'
    AND
      `conv1`.`network` = `total`.`network`
  LEFT JOIN `repo_adw_adgroup_report_conv` AS conv2
    ON
      `total`.`account_id` = `conv2`.`account_id`
    AND
      `total`.`customerID` = `conv2`.`customerID`
    AND
      `total`.`day` = `conv2`.`day`
    AND
      `total`.`campaignID` = `conv2`.`campaignID`
    AND
      `total`.`adGroupID` = `conv2`.`adGroupID`
    AND
      `conv2`.`conversionName` = 'Conversion Name 2'
    AND
      `conv2`.`network` = `total`.`network`
  LEFT JOIN `repo_adw_adgroup_report_conv` AS conv3
    ON
      `total`.`account_id` = `conv3`.`account_id`
    AND
      `total`.`customerID` = `conv3`.`customerID`
    AND
      `total`.`day` = `conv3`.`day`
    AND
      `total`.`campaignID` = `conv3`.`campaignID`
    AND
      `total`.`adGroupID` = `conv3`.`adGroupID`
    AND
      `conv3`.`conversionName` = 'Conversion Name 3'
    AND
      `conv3`.`network` = `total`.`network`
  LEFT JOIN (`campaigns` AS call1_campaigns, `phone_time_use` AS call1)
    ON
      `call1_campaigns`.`campaign_id` = `total`.`campaign_id`
    AND
      `call1_campaigns`.`account_id` = `total`.`account_id`
    AND
      (
        (
          `call1_campaigns`.`camp_custom1` = 'adgroupid'
        AND
          `call1`.`custom1` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom2` = 'adgroupid'
        AND
          `call1`.`custom2` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom3` = 'adgroupid'
        AND
          `call1`.`custom3` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom4` = 'adgroupid'
        AND
          `call1`.`custom4` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom5` = 'adgroupid'
        AND
          `call1`.`custom5` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom6` = 'adgroupid'
        AND
          `call1`.`custom6` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom7` = 'adgroupid'
        AND
          `call1`.`custom7` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom8` = 'adgroupid'
        AND
          `call1`.`custom8` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom9` = 'adgroupid'
        AND
          `call1`.`custom9` = `total`.`adGroupID`
        )
      OR
        (
          `call1_campaigns`.`camp_custom10` = 'adgroupid'
        AND
          `call1`.`custom10` = `total`.`adGroupID`
        )
      )
    AND
      `call1`.`utm_campaign` = `total`.`campaignID`
    AND
      `call1`.`account_id` = `total`.`account_id`
    AND
      `call1`.`campaign_id` = `total`.`campaign_id`
    AND
      STR_TO_DATE(`call1`.`time_of_call`, '%Y-%m-%d') = `total`.`day`
    AND
      `call1`.`phone_number` = '+841234567811'
    AND
      `call1`.`source` = 'adw'
    AND
      `call1`.`traffic_type` = 'AD'
    AND
      `total`.`network` = 'SEARCH'
  LEFT JOIN `repo_adw_ad_report_cost` AS ad_report
    ON
      `total`.`adGroupID` = `ad_report`.`adGroupID`
    AND
      `total`.`day` = `ad_report`.`day`
    AND
      `total`.`network` = 'CONTENT'
  LEFT JOIN (`campaigns` AS ad_call1_campaigns, `phone_time_use` AS ad_call1)
    ON
      `ad_report`.`account_id` = `ad_call1_campaigns`.`account_id`
    AND
      `ad_report`.`campaign_id` = `ad_call1_campaigns`.`campaign_id`
    AND
        (
          `ad_call1_campaigns`.`camp_custom1` = 'creative'
        AND
          `ad_call1`.`custom1` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom2` = 'creative'
        AND
          `ad_call1`.`custom2` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom3` = 'creative'
        AND
          `ad_call1`.`custom3` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom4` = 'creative'
        AND
          `ad_call1`.`custom4` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom5` = 'creative'
        AND
          `ad_call1`.`custom5` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom6` = 'creative'
        AND
          `ad_call1`.`custom6` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom7` = 'creative'
        AND
          `ad_call1`.`custom7` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom8` = 'creative'
        AND
          `ad_call1`.`custom8` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom9` = 'creative'
        AND
          `ad_call1`.`custom9` = `ad_report`.`adID`
        )
      OR
        (
          `ad_call1_campaigns`.`camp_custom10` = 'creative'
        AND
          `ad_call1`.`custom10` = `ad_report`.`adID`
        )
    AND
      `ad_call1`.`utm_campaign` = `ad_report`.`campaignID`
    AND
      `ad_call1`.`account_id` = `ad_report`.`account_id`
    AND
      `ad_call1`.`campaign_id` = `ad_report`.`campaign_id`
    AND
      STR_TO_DATE(`ad_call1`.`time_of_call`, '%Y-%m-%d') = `ad_report`.`day`
    AND
      `ad_call1`.`phone_number` = '+841234567811'
    AND
      `ad_call1`.`source` = 'adw'
    AND
      `ad_call1`.`traffic_type` = 'AD'
WHERE
  `total`.`campaignID` = 11
AND
  `total`.`day` >= '2017-01-01'
AND
  `total`.`day` <= '2017-12-01'
AND
  (
    `total`.`network` = 'SEARCH'
  OR
    `total`.`network` = 'CONTENT'
  )
GROUP BY
  `total`.`account_id`,
  `total`.`customerID`,
  `total`.`campaignID`,
  `total`.`adGroupID`;
