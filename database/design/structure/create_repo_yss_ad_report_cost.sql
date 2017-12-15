/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_yss_ad_report_cost
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_yss_ad_report_cost` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `exeDate` DATE NOT NULL COMMENT 'YSSレポートAPI実行日',
  `startDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの開始日',
  `endDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの終了日',
  `account_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのアカウントID',
  `campaign_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのキャンペーンID\ndestinationURLのクエリパラメータを分解して取得',
  `accountid` INT(20) NULL DEFAULT NULL COMMENT 'YSSのアカウントID。レポートのダウンロードURL取得時のアカウントIDを入れます。',
  `campaignID` INT(20) NULL DEFAULT NULL COMMENT 'キャンペーンID',
  `adgroupID` INT(20) NULL DEFAULT NULL COMMENT '広告グループID',
  `adID` INT(20) NULL DEFAULT NULL COMMENT '広告ID',
  `campaignName` TEXT NULL DEFAULT NULL COMMENT 'キャンペーン名',
  `adgroupName` TEXT NULL DEFAULT NULL COMMENT '広告グループ名',
  `adName` TEXT NULL DEFAULT NULL COMMENT '広告名',
  `title` TEXT NULL DEFAULT NULL COMMENT 'タイトル',
  `description1` TEXT NULL DEFAULT NULL COMMENT '説明文1',
  `displayURL` TEXT NULL DEFAULT NULL COMMENT '表示URL',
  `destinationURL` TEXT NULL DEFAULT NULL COMMENT 'リンク先URL',
  `adType` VARCHAR(50) NULL DEFAULT NULL COMMENT '広告タイプ',
  `adDistributionSettings` VARCHAR(50) NULL DEFAULT NULL COMMENT '配信設定',
  `adEditorialStatus` VARCHAR(50) NULL DEFAULT NULL COMMENT '審査状況',
  `cost` INT(20) NULL DEFAULT NULL COMMENT 'コスト',
  `impressions` INT(20) NULL DEFAULT NULL COMMENT 'インプレッション数',
  `clicks` INT(20) NULL DEFAULT NULL COMMENT 'クリック数',
  `ctr` DOUBLE NULL DEFAULT NULL COMMENT 'クリック率',
  `averageCpc` DOUBLE NULL DEFAULT NULL COMMENT '平均CPC',
  `averagePosition` DOUBLE NULL DEFAULT NULL COMMENT '平均掲載順位',
  `description2` TEXT NULL DEFAULT NULL COMMENT '説明文2',
  `focusDevice` VARCHAR(50) NULL DEFAULT NULL COMMENT '優先デバイス',
  `trackingURL` TEXT NULL DEFAULT NULL COMMENT 'トラッキングURL',
  `customParameters` TEXT NULL DEFAULT NULL COMMENT 'カスタムパラメータ',
  `landingPageURL` TEXT NULL DEFAULT NULL COMMENT '最終リンク先URL',
  `landingPageURLSmartphone` TEXT NULL DEFAULT NULL COMMENT '最終リンク先URL（スマートフォン）',
  `adTrackingID` INT(20) NULL DEFAULT NULL COMMENT '広告トラッキングID',
  `conversions` DOUBLE NULL DEFAULT NULL COMMENT 'コンバージョン数',
  `convRate` DOUBLE NULL DEFAULT NULL COMMENT 'コンバージョン率',
  `convValue` DOUBLE NULL DEFAULT NULL COMMENT 'コンバージョンの価値',
  `costPerConv` DOUBLE NULL DEFAULT NULL COMMENT 'コスト/コンバージョン数',
  `valuePerConv` DOUBLE NULL DEFAULT NULL COMMENT '価値/コンバージョン数',
  `allConv` DOUBLE NULL DEFAULT NULL COMMENT 'すべてのコンバージョン数',
  `allConvRate` DOUBLE NULL DEFAULT NULL COMMENT 'すべてのコンバージョン率',
  `allConvValue` DOUBLE NULL DEFAULT NULL COMMENT 'すべてのコンバージョンの価値',
  `costPerAllConv` DOUBLE NULL DEFAULT NULL COMMENT 'コスト/すべてのコンバージョン数',
  `valuePerAllConv` DOUBLE NULL DEFAULT NULL COMMENT '価値/すべてのコンバージョン数',
  `network` VARCHAR(50) NULL DEFAULT NULL COMMENT '広告掲載方式の指定',
  `clickType` VARCHAR(50) NULL DEFAULT NULL COMMENT 'クリック種別',
  `device` VARCHAR(50) NULL DEFAULT NULL COMMENT 'デバイス',
  `day` DATETIME NULL DEFAULT NULL COMMENT 'レコードの対象日：年（year）、月（monthofYear）、日（day）。左項目を加工してDATETIMEに変換',
  `dayOfWeek` VARCHAR(50) NULL DEFAULT NULL COMMENT '曜日',
  `quarter` VARCHAR(50) NULL DEFAULT NULL COMMENT '四半期',
  `month` VARCHAR(50) NULL DEFAULT NULL COMMENT '毎月',
  `week` VARCHAR(50) NULL DEFAULT NULL COMMENT '毎週',
  `adKeywordID` INT(20) NULL DEFAULT NULL COMMENT 'キーワードID',
  `title1` TEXT NULL DEFAULT NULL COMMENT 'タイトル1',
  `title2` TEXT NULL DEFAULT NULL COMMENT 'タイトル2',
  `description` TEXT NULL DEFAULT NULL COMMENT '説明文',
  `directory1` TEXT NULL DEFAULT NULL COMMENT 'ディレクトリ1',
  `directory2` TEXT NULL DEFAULT NULL COMMENT 'ディレクトリ2',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `repo_yss_ad_report_cost_idx1` (`account_id` ASC),
  INDEX `repo_yss_ad_report_cost_idx2` (`campaign_id` ASC),
  INDEX `repo_yss_ad_report_cost_idx3` (`network` ASC),
  INDEX `repo_yss_ad_report_cost_idx4` (`clickType` ASC),
  INDEX `repo_yss_ad_report_cost_idx5` (`device` ASC),
  INDEX `repo_yss_ad_report_cost_idx6` (`day` ASC),
  INDEX `repo_yss_ad_report_cost_idx7` (`dayOfWeek` ASC),
  INDEX `repo_yss_ad_report_cost_idx8` (`month` ASC),
  INDEX `repo_yss_ad_report_cost_idx9` (`week` ASC),
  INDEX `repo_yss_ad_report_cost_idx10` (`adKeywordID` ASC),
  INDEX `repo_yss_ad_report_cost_idx11` (`quarter` ASC),
  INDEX `repo_yss_ad_report_cost_idx12` (`campaignID` ASC),
  INDEX `repo_yss_ad_report_cost_idx13` (`adgroupID` ASC),
  INDEX `repo_yss_ad_report_cost_idx14` (`adID` ASC),
  INDEX `repo_yss_ad_report_cost_idx15` (`exeDate` ASC),
  INDEX `repo_yss_ad_report_cost_idx16` (`startDate` ASC),
  INDEX `repo_yss_ad_report_cost_idx17` (`endDate` ASC),
  INDEX `repo_yss_ad_report_cost_idx18` (`accountid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'YSS広告レポート（コスト）';
