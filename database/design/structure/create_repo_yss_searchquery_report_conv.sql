/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_yss_searchquery_report_conv
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_yss_searchquery_report_conv` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `exeDate` DATE NOT NULL COMMENT 'YSSレポートAPI実行日',
  `startDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの開始日',
  `endDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの終了日',
  `account_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのアカウントID',
  `campaign_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのキャンペーンID\ndestinationURLのクエリパラメータを分解して取得',
  `accountid` INT(20) NULL DEFAULT NULL COMMENT 'YSSのアカウントID。レポートのダウンロードURL取得時のアカウントIDを入れます。',
  `campaignID` INT(20) NULL COMMENT 'キャンペーンID',
  `adgroupID` INT(20) NULL COMMENT '広告グループID',
  `keywordID` INT(20) NULL COMMENT 'キーワードID',
  `campaignName` TEXT NULL COMMENT 'キャンペーン名',
  `adgroupName` TEXT NULL COMMENT '広告グループ名',
  `searchQueryDestinationURL` TEXT NULL COMMENT 'クリックされたURL',
  `searchQuery` TEXT NULL COMMENT '検索クエリー',
  `searchQueryMatchType` VARCHAR(50) NULL COMMENT '検索クエリーのマッチタイプ',
  `keyword` TEXT NULL COMMENT 'キーワード',
  `trackingURL` TEXT NULL COMMENT 'トラッキングURL',
  `landingPageURL` TEXT NULL COMMENT '最終リンク先URL',
  `conversions` DOUBLE NULL COMMENT 'コンバージョン数',
  `convValue` DOUBLE NULL COMMENT 'コンバージョンの価値',
  `valuePerConv` DOUBLE NULL COMMENT '価値/コンバージョン数',
  `allConv` DOUBLE NULL COMMENT 'すべてのコンバージョン数',
  `allConvValue` DOUBLE NULL COMMENT 'すべてのコンバージョンの価値',
  `valuePerAllConv` DOUBLE NULL COMMENT '価値/すべてのコンバージョン数',
  `campaignTrackingID` INT(20) NULL COMMENT 'キャンペーントラッキングID',
  `adgroupTrackingID` INT(20) NULL COMMENT '広告グループトラッキングID',
  `keywordTrackingID` INT(20) NULL COMMENT 'キーワードトラッキングID',
  `network` VARCHAR(50) NULL COMMENT '広告掲載方式の指定',
  `device` VARCHAR(50) NULL COMMENT 'デバイス',
  `day` DATETIME NULL COMMENT 'レコードの対象日：年（year）、月（monthofYear）、日（day）。左項目を加工してDATETIMEに変換',
  `dayOfWeek` VARCHAR(50) NULL COMMENT '曜日',
  `quarter` VARCHAR(50) NULL COMMENT '四半期',
  `month` VARCHAR(50) NULL COMMENT '毎月',
  `week` VARCHAR(50) NULL COMMENT '毎週',
  `objectiveOfConversionTracking` VARCHAR(50) NULL COMMENT 'コンバージョン測定の目的',
  `conversionName` TEXT NULL COMMENT 'コンバージョン名',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx1` (`account_id` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx2` (`campaign_id` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx3` (`campaignID` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx4` (`adgroupID` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx5` (`keywordID` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx6` (`campaignTrackingID` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx7` (`adgroupTrackingID` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx8` (`keywordTrackingID` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx9` (`network` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx10` (`device` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx11` (`day` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx12` (`dayOfWeek` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx13` (`quarter` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx14` (`month` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx15` (`week` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx16` (`objectiveOfConversionTracking` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx17` (`exeDate` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx18` (`startDate` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx19` (`endDate` ASC),
  INDEX `repo_yss_searchquery_report_conv_idx20` (`accountid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'YSS検索クエリレポート（コンバージョン）';
