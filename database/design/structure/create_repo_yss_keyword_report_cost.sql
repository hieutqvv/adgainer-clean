/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_yss_keyword_report_cost
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_yss_keyword_report_cost` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `exeDate` DATE NOT NULL COMMENT 'YSSレポートAPI実行日',
  `startDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの開始日',
  `endDate` DATE NOT NULL COMMENT 'YSSレポートAPIで指定したレポートの終了日',
  `account_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのアカウントID',
  `campaign_id` VARCHAR(50) NULL DEFAULT NULL COMMENT 'ADgainerシステムのキャンペーンID\ndestinationURLのクエリパラメータを分解して取得',
  `accountid` INT(20) NULL DEFAULT NULL COMMENT 'YSSのアカウントID。レポートのダウンロードURL取得時のアカウントIDを入れます。',
  `campaignID` INT(20) NULL DEFAULT NULL COMMENT 'キャンペーンID',
  `adgroupID` INT(20) NULL DEFAULT NULL COMMENT '広告グループID',
  `keywordID` INT(20) NULL DEFAULT NULL COMMENT 'キーワードID',
  `campaignName` TEXT NULL DEFAULT NULL COMMENT 'キャンペーン名',
  `adgroupName` TEXT NULL DEFAULT NULL COMMENT '広告グループ名',
  `customURL` TEXT NULL DEFAULT NULL COMMENT 'カスタムURL',
  `keyword` TEXT NULL DEFAULT NULL COMMENT 'キーワード',
  `keywordDistributionSettings` VARCHAR(50) NULL DEFAULT NULL COMMENT '配信設定',
  `kwEditorialStatus` VARCHAR(50) NULL DEFAULT NULL COMMENT '審査状況',
  `adGroupBid` INT(20) NULL DEFAULT NULL COMMENT '広告グループの入札価格',
  `bid` INT(20) NULL DEFAULT NULL COMMENT '入札価格',
  `negativeKeywords` TEXT NULL DEFAULT NULL COMMENT '対象外キーワード',
  `qualityIndex` INT(20) NULL DEFAULT NULL COMMENT '品質インデックス',
  `firstPageBidEstimate` INT(20) NULL DEFAULT NULL COMMENT '1ページ目掲載に必要な入札価格',
  `keywordMatchType` VARCHAR(50) NULL DEFAULT NULL COMMENT 'マッチタイプ',
  `cost` INT(20) NULL DEFAULT NULL COMMENT 'コスト',
  `impressions` INT(20) NULL DEFAULT NULL COMMENT 'インプレッション数',
  `clicks` INT(20) NULL DEFAULT NULL COMMENT 'クリック数',
  `ctr` DOUBLE NULL DEFAULT NULL COMMENT 'クリック率',
  `averageCpc` DOUBLE NULL DEFAULT NULL COMMENT '平均CPC',
  `averagePosition` DOUBLE NULL DEFAULT NULL COMMENT '平均掲載順位',
  `impressionShare` DOUBLE NULL DEFAULT NULL COMMENT 'インプレッションシェア',
  `exactMatchImpressionShare` DOUBLE NULL DEFAULT NULL COMMENT '完全一致のインプレッションシェア',
  `qualityLostImpressionShare` DOUBLE NULL DEFAULT NULL COMMENT 'インプレッション損失率（掲載順位）',
  `topOfPageBidEstimate` INT(20) NULL DEFAULT NULL COMMENT '1ページ目上部掲載に必要な入札価格',
  `trackingURL` TEXT NULL DEFAULT NULL COMMENT 'トラッキングURL',
  `customParameters` TEXT NULL DEFAULT NULL COMMENT 'カスタムパラメータ',
  `landingPageURL` TEXT NULL DEFAULT NULL COMMENT '最終リンク先URL',
  `landingPageURLSmartphone` TEXT NULL DEFAULT NULL COMMENT '最終リンク先URL（スマートフォン）',
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
  `device` VARCHAR(50) NULL DEFAULT NULL COMMENT 'デバイス',
  `day` DATETIME NULL DEFAULT NULL COMMENT 'レコードの対象日：年（year）、月（monthofYear）、日（day）。左項目を加工してDATETIMEに変換',
  `dayOfWeek` VARCHAR(50) NULL DEFAULT NULL COMMENT '曜日',
  `quarter` VARCHAR(50) NULL DEFAULT NULL COMMENT '四半期',
  `month` VARCHAR(50) NULL DEFAULT NULL COMMENT '毎月',
  `week` VARCHAR(50) NULL DEFAULT NULL COMMENT '毎週',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `repo_yss_keyword_report_cost_idx1` (`account_id` ASC),
  INDEX `repo_yss_keyword_report_cost_idx2` (`campaign_id` ASC),
  INDEX `repo_yss_keyword_report_cost_idx3` (`network` ASC),
  INDEX `repo_yss_keyword_report_cost_idx4` (`device` ASC),
  INDEX `repo_yss_keyword_report_cost_idx5` (`day` ASC),
  INDEX `repo_yss_keyword_report_cost_idx6` (`dayOfWeek` ASC),
  INDEX `repo_yss_keyword_report_cost_idx7` (`quarter` ASC),
  INDEX `repo_yss_keyword_report_cost_idx8` (`month` ASC),
  INDEX `repo_yss_keyword_report_cost_idx9` (`week` ASC),
  INDEX `repo_yss_keyword_report_cost_idx10` (`campaignID` ASC),
  INDEX `repo_yss_keyword_report_cost_idx11` (`adgroupID` ASC),
  INDEX `repo_yss_keyword_report_cost_idx12` (`keywordID` ASC),
  INDEX `repo_yss_keyword_report_cost_idx13` (`exeDate` ASC),
  INDEX `repo_yss_keyword_report_cost_idx14` (`startDate` ASC),
  INDEX `repo_yss_keyword_report_cost_idx15` (`endDate` ASC),
  INDEX `repo_yss_keyword_report_cost_idx16` (`accountid` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'YSSキーワードレポート（コスト）';
