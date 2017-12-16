/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_yss_campaign_report_cost
 * Auther : Tetsuya Takiguchi
 * Update : 2017/08/03 Modify columns & index
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_yss_campaign_report_cost` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `exeDate` DATE NOT NULL COMMENT 'YSSレポートAPI実行日',
  `startDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの開始日',
  `endDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの終了日',
  `account_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのアカウントID',
  `campaign_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのキャンペーンID\ndestinationURLのクエリパラメータを分解して取得',
  `accountid` INT(20) NULL DEFAULT NULL COMMENT 'YSSのアカウントID。レポートのダウンロードURL取得時のアカウントIDを入れます。',
  `campaignID` INT(20) NULL COMMENT 'キャンペーンID',
  `campaignName` TEXT NULL COMMENT 'キャンペーン名',
  `campaignDistributionSettings` VARCHAR(50) NULL COMMENT 'キャンペーン配信設定',
  `campaignDistributionStatus` VARCHAR(50) NULL COMMENT '配信状況',
  `dailySpendingLimit` INT(20) NULL COMMENT '1日の予算',
  `campaignStartDate` DATETIME NULL COMMENT '開始日',
  `campaignEndDate` DATETIME NULL COMMENT '終了日',
  `cost` INT(20) NULL COMMENT 'コスト',
  `impressions` INT(20) NULL COMMENT 'インプレッション数',
  `clicks` INT(20) NULL COMMENT 'クリック数',
  `ctr` DOUBLE NULL COMMENT 'クリック率',
  `averageCpc` DOUBLE NULL COMMENT '平均CPC',
  `averagePosition` DOUBLE NULL COMMENT '平均掲載順位',
  `impressionShare` DOUBLE NULL COMMENT 'インプレッションシェア',
  `exactMatchImpressionShare` DOUBLE NULL COMMENT '完全一致のインプレッションシェア',
  `budgetLostImpressionShare` DOUBLE NULL COMMENT 'インプレッション損失率（予算）',
  `qualityLostImpressionShare` DOUBLE NULL COMMENT 'インプレッション損失率（掲載順位）',
  `trackingURL` TEXT NULL COMMENT 'トラッキングURL',
  `customParameters` TEXT NULL COMMENT 'カスタムパラメータ',
  `campaignTrackingID` INT(20) NULL COMMENT 'キャンペーントラッキングID',
  `conversions` DOUBLE NULL COMMENT 'コンバージョン数',
  `convRate` DOUBLE NULL COMMENT 'コンバージョン率',
  `convValue` DOUBLE NULL COMMENT 'コンバージョンの価値',
  `costPerConv` DOUBLE NULL COMMENT 'コスト/コンバージョン数',
  `valuePerConv` DOUBLE NULL COMMENT '価値/コンバージョン数',
  `mobileBidAdj` DOUBLE NULL COMMENT 'スマートフォン入札価格調整率（％）',
  `desktopBidAdj` DOUBLE NULL COMMENT 'PC入札価格調整率（％）',
  `tabletBidAdj` DOUBLE NULL COMMENT 'タブレット入札価格調整率（％）',
  `network` VARCHAR(50) NULL COMMENT '広告掲載方式の指定',
  `device` VARCHAR(50) NULL COMMENT 'デバイス',
  `day` DATETIME NULL COMMENT 'レコードの対象日：年（year）、月（monthofYear）、日（day）。左項目を加工してDATETIMEに変換',
  `dayOfWeek` VARCHAR(50) NULL COMMENT '曜日',
  `quarter` VARCHAR(50) NULL COMMENT '四半期',
  `month` VARCHAR(50) NULL COMMENT '毎月',
  `week` VARCHAR(50) NULL COMMENT '毎週',
  `hourofday` INT(20) NULL COMMENT '時間',
  `campaignType` VARCHAR(50) NULL COMMENT 'キャンペーンタイプ',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `repo_yss_campaign_report_cost_idx1` (`account_id` ASC),
  INDEX `repo_yss_campaign_report_cost_idx2` (`campaign_id` ASC),
  INDEX `repo_yss_campaign_report_cost_idx3` (`campaignStartDate` ASC),
  INDEX `repo_yss_campaign_report_cost_idx4` (`campaignEndDate` ASC),
  INDEX `repo_yss_campaign_report_cost_idx5` (`network` ASC),
  INDEX `repo_yss_campaign_report_cost_idx6` (`device` ASC),
  INDEX `repo_yss_campaign_report_cost_idx7` (`day` ASC),
  INDEX `repo_yss_campaign_report_cost_idx8` (`dayOfWeek` ASC),
  INDEX `repo_yss_campaign_report_cost_idx9` (`quarter` ASC),
  INDEX `repo_yss_campaign_report_cost_idx10` (`month` ASC),
  INDEX `repo_yss_campaign_report_cost_idx11` (`week` ASC),
  INDEX `repo_yss_campaign_report_cost_idx12` (`hourofday` ASC),
  INDEX `repo_yss_campaign_report_cost_idx13` (`campaignType` ASC),
  INDEX `repo_yss_campaign_report_cost_idx14` (`exeDate` ASC),
  INDEX `repo_yss_campaign_report_cost_idx15` (`startDate` ASC),
  INDEX `repo_yss_campaign_report_cost_idx16` (`endDate` ASC),
  INDEX `repo_yss_campaign_report_cost_idx17` (`accountid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'YSSキャンペーンレポート（コスト）';