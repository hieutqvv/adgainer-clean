/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_yss_searchquery_report_cost
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_yss_searchquery_report_cost` (
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
  `cost` INT(20) NULL COMMENT 'コスト',
  `impressions` INT(20) NULL COMMENT 'インプレッション数',
  `clicks` INT(20) NULL COMMENT 'クリック数',
  `ctr` DOUBLE NULL COMMENT 'クリック率',
  `averageCpc` DOUBLE NULL COMMENT '平均CPC',
  `averagePosition` DOUBLE NULL COMMENT '平均掲載順位',
  `trackingURL` TEXT NULL COMMENT 'トラッキングURL',
  `landingPageURL` TEXT NULL COMMENT '最終リンク先URL',
  `conversions` DOUBLE NULL COMMENT 'コンバージョン数',
  `convRate` DOUBLE NULL COMMENT 'コンバージョン率',
  `convValue` DOUBLE NULL COMMENT 'コンバージョンの価値',
  `costPerConv` DOUBLE NULL COMMENT 'コスト/コンバージョン数',
  `valuePerConv` DOUBLE NULL COMMENT '価値/コンバージョン数',
  `allConv` DOUBLE NULL COMMENT 'すべてのコンバージョン数',
  `allConvRate` DOUBLE NULL COMMENT 'すべてのコンバージョン率',
  `allConvValue` DOUBLE NULL COMMENT 'すべてのコンバージョンの価値',
  `costPerAllConv` DOUBLE NULL COMMENT 'コスト/すべてのコンバージョン数',
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
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx1` (`account_id` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx2` (`campaign_id` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx3` (`campaignID` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx4` (`adgroupID` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx5` (`keywordID` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx6` (`campaignTrackingID` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx7` (`adgroupTrackingID` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx8` (`keywordTrackingID` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx9` (`network` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx10` (`device` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx11` (`day` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx12` (`dayOfWeek` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx13` (`quarter` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx14` (`month` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx15` (`week` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx16` (`exeDate` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx17` (`startDate` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx18` (`endDate` ASC),
  INDEX `repo_yss_searchquery_report_cost_idx19` (`accountid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'YSS検索クエリレポート（コスト）';
