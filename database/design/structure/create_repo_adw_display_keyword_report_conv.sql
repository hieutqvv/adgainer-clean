/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_adw_display_keyword_report_conv
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_adw_display_keyword_report_conv` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`exeDate` DATE NOT NULL COMMENT 'レポートAPI実行日',
	`startDate` DATE NOT NULL COMMENT 'APIで指定したレポートの開始日',
	`endDate` DATE NOT NULL COMMENT 'APIで指定したレポートの終了日',
	`account_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのアカウントID',
	`campaign_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのキャンペーンID。destinationURLのクエリパラメータを分解して取得',
	`currency` VARCHAR(50) NULL COMMENT '顧客アカウントの通貨。',
	`account` TEXT NULL COMMENT 'カスタマーアカウントのわかりやすい名前。',
	`timeZone` VARCHAR(50) NULL COMMENT '顧客アカウント用に選択されたタイムゾーンの名前。たとえば、「（GMT-05：00）東部時間」などです。このフィールドには、タイムゾーンの夏時間の現在の状態は反映されません。',
	`adGroupID` INT(20) NULL COMMENT '広告グループのID。',
	`adGroup` TEXT NULL COMMENT '広告グループの名前。',
	`adGroupState` VARCHAR(50) NULL COMMENT '広告グループのステータス。',
	`network` VARCHAR(50) NULL COMMENT '第1レベルのネットワークタイプ。',
	`networkWithSearchPartners` VARCHAR(50) NULL COMMENT '第2レベルのネットワークタイプ（検索パートナーを含む）。',
	`allConvRate` Double NULL COMMENT 'AllConversionsをコンバージョントラッキングできる合計クリック数で割ったものです。これは、広告のクリックがコンバージョンにつながった頻度です。',
	`allConv` Double NULL COMMENT 'AdWordsが推進するコンバージョン数の最善の見積もり。ウェブサイト、クロスデバイス、電話通話のコンバージョンが含まれます。',
	`allConvValue` Double NULL COMMENT '推定されたものを含む、すべてのコンバージョンの合計値。',
	`baseAdGroupID` INT(20) NULL COMMENT '試用広告グループの基本広告グループのID。通常の広告グループの場合、これはAdGroupIdと同じです。',
	`baseCampaignID` INT(20) NULL COMMENT '試用キャンペーンの基本キャンペーンのID。通常のキャンペーンの場合、これはCampaignIdと同じです。',
	`conversionOptimizerBidType` VARCHAR(50) NULL COMMENT '入札タイプ。',
	`campaignID` INT(20) NULL COMMENT 'キャンペーンのID。',
	`campaign` TEXT NULL COMMENT 'キャンペーンの名前。',
	`campaignState` VARCHAR(50) NULL COMMENT 'キャンペーンのステータス。',
	`clickType` VARCHAR(50) NULL COMMENT '[インプレッション数]フィールドには、そのクリックタイプで広告が配信された頻度が反映されます。広告は複数のクリックタイプで表示できるため、インプレッション数は2倍になり、合計が正確でない可能性があります。',
	`conversionCategory` VARCHAR(255) NULL COMMENT 'ユーザーがコンバージョンを達成するために実行するアクションを表すカテゴリ。ゼロ変換の行が返されないようにします。値：「ダウンロード」、「リード」、「購入/販売」、「サインアップ」、「キーページの表示」、「その他」の値。',
	`convRate` Double NULL COMMENT 'コンバージョン数をコンバージョンにトラッキングできる合計クリック数で割ったものです。',
	`conversions` Double NULL COMMENT '最適化を選択したすべてのコンバージョンアクションのコンバージョン数。',
	`conversionTrackerId` INT(20) NULL COMMENT 'コンバージョントラッカーのID。',
	`conversionName` VARCHAR(255) NULL COMMENT 'コンバージョンタイプの名前。ゼロ変換の行が返されないようにします。',
	`totalConvValue` Double NULL COMMENT 'すべてのコンバージョンのコンバージョン値の合計。',
	`costAllConv` Double NULL COMMENT '総費用をすべてのコンバージョンで割った値。',
	`costConv` Double NULL COMMENT 'コンバージョントラッキングクリック数に起因する費用をコンバージョン数で割った値',
	`maxCPC` Double NULL COMMENT 'クリック単価制。値は、a）小額の金額、b）AdWordsが自動的に選択された入札戦略で入札単価を設定する場合は「自動：x」または「自動」、c）クリック単価が適用されない場合は「 - 」のいずれかです行に',
	`maxCPCSource` VARCHAR(50) NULL COMMENT 'CPC入札のソース。',
	`maxCPM` Double NULL COMMENT 'CPM（1,000インプレッションあたりの単価）の単価',
	`maxCPMSource` VARCHAR(50) NULL COMMENT 'CPM入札のソース。',
	`maxCPV` Double NULL COMMENT '視聴単価制の入札単価値は、a）小額の金額、b）AdWordsが自動的に選択した入札戦略で入札単価を設定している場合は「自動：x」または「自動」、またはc）入札単価が適用されない場合は「 - 」のいずれかです行に',
	`maxCPVSource` VARCHAR(50) NULL COMMENT '視聴単価の入札価格です。',
	`keyword` TEXT NULL COMMENT 'Criterionの記述的な文字列。レポートの条件タイプのフォーマットの詳細については、条件プレフィックス(URL:https://developers.google.com/adwords/api/docs/guides/reporting#criteria_prefixes)のセクションをご覧ください。',
	`destinationURL` TEXT NULL COMMENT '広告を表示した条件のリンク先URL。',
	`crossDeviceConv` Double NULL COMMENT '顧客が1つの端末でAdWords広告をクリックしてから別の端末やブラウザで変換した後のコンバージョンデバイス間のコンバージョンは既にAllConversions列に含まれています。',
	`clientName` TEXT NULL COMMENT 'カスタマーのわかりやすい名前。',
	`day` Date NULL COMMENT '日付はyyyy-MM-ddの形式になります。',
	`dayOfWeek` VARCHAR(50) NULL COMMENT '曜日の名前です（例：「月曜日」）。',
	`device` VARCHAR(50) NULL COMMENT 'インプレッションが表示されたデバイスの種類。',
	`conversionSource` VARCHAR(50) NULL COMMENT 'ウェブサイトなどの変換元、通話からのインポート。',
	`customerID` INT(20) NULL COMMENT '顧客ID。',
	`appFinalURL` TEXT NULL COMMENT 'この行のメインオブジェクトの最終的なアプリURLのリスト。リストのエントリは、a）「android-app：」（Androidアプリの場合）またはb）「os-app：」（iOSアプリの場合）のいずれかで始まります。 AppUrlList要素はJSONリスト形式で返されます。',
	`mobileFinalURL` TEXT NULL COMMENT 'この行のメインオブジェクトの最終的なモバイルURLのリスト。 UrlList要素はJSONリスト形式で返されます。',
	`finalURL` TEXT NULL COMMENT 'この行の主要オブジェクトの最終的なURLのリスト。 UrlList要素はJSONリスト形式で返されます。',
	`gmailForwards` INT(20) NULL COMMENT '広告が誰かにメッセージとして転送された回数。',
	`gmailSaves` INT(20) NULL COMMENT 'Gmail広告をメッセージとして受信トレイに保存した回数。',
	`gmailClicksToWebsite` INT(20) NULL COMMENT 'Gmail広告の展開状態でのリンク先ページへのクリック数。',
	`keywordID` INT(20) NULL COMMENT 'この行の主オブジェクトのID。',
	`isNegative` Boolean NULL COMMENT 'この行の基準が否定（除外）基準であるかどうかを示します。',
	`isRestricting` Boolean NULL COMMENT 'trueの値は、基準タイプが入札単価とターゲティング制限に使用されていることを示します。falseの値は、基準タイプが入札にのみ使用されることを示します。これは、基準の対応するAdGroup.TargetingSettingDetailのtargetAllと反対の値になります。たとえば、criterionTypeGroup = PLACEMENTのTargetingSettingDetailにtargetAll = trueが設定されている場合、IsRestrictフィールドは配置基準に対してfalseになります。',
	`month` Date NULL COMMENT '月の最初の日。yyyy-MM-ddの形式です。',
	`monthOfYear` VARCHAR(50) NULL COMMENT '月の名前です（例：「12月」）。',
	`quarter` Date NULL COMMENT '四半期の最初の日は、yyyy-MM-ddの形式です。四半期の暦年を使用します。たとえば、2014年第2四半期は2014-04-01に開始します。',
	`keywordState` TEXT NULL COMMENT 'この行のメインオブジェクトのステータス。たとえば、キャンペーンの掲載結果レポートでは、これが各行のキャンペーンのステータスになります。広告グループの掲載結果レポートでは、これは各行の広告グループのステータスになります。',
	`trackingTemplate` TEXT NULL COMMENT 'この行のメインオブジェクトのトラッキングテンプレート。',
	`customParameter` TEXT NULL COMMENT 'この行のメインオブジェクトのカスタムURLパラメータ。 CustomParameters要素はJSONマップ形式で返されます。',
	`valueAllConv` Double NULL COMMENT 'すべてのコンバージョンの平均値です。',
	`valueConv` Double NULL COMMENT 'コンバージョン数の合計をコンバージョン数で割った値。',
	`week` Date NULL COMMENT 'yyyy-MM-ddの形式の月曜日の日付。',
	`year` INT NULL COMMENT '年はyyyyの形式です。',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id_UNIQUE` (`id` ASC),
	INDEX `repo_adw_display_keyword_report_conv1` (`exeDate` ASC),
	INDEX `repo_adw_display_keyword_report_conv2` (`startDate` ASC),
	INDEX `repo_adw_display_keyword_report_conv3` (`endDate` ASC),
	INDEX `repo_adw_display_keyword_report_conv4` (`account_id` ASC),
	INDEX `repo_adw_display_keyword_report_conv5` (`campaign_id` ASC),
	INDEX `repo_adw_display_keyword_report_conv6` (`currency` ASC),
	INDEX `repo_adw_display_keyword_report_conv7` (`timeZone` ASC),
	INDEX `repo_adw_display_keyword_report_conv8` (`adGroupID` ASC),
	INDEX `repo_adw_display_keyword_report_conv9` (`adGroupState` ASC),
	INDEX `repo_adw_display_keyword_report_conv10` (`network` ASC),
	INDEX `repo_adw_display_keyword_report_conv11` (`networkWithSearchPartners` ASC),
	INDEX `repo_adw_display_keyword_report_conv12` (`baseAdGroupID` ASC),
	INDEX `repo_adw_display_keyword_report_conv13` (`baseCampaignID` ASC),
	INDEX `repo_adw_display_keyword_report_conv14` (`conversionOptimizerBidType` ASC),
	INDEX `repo_adw_display_keyword_report_conv15` (`campaignID` ASC),
	INDEX `repo_adw_display_keyword_report_conv16` (`campaignState` ASC),
	INDEX `repo_adw_display_keyword_report_conv17` (`clickType` ASC),
	INDEX `repo_adw_display_keyword_report_conv18` (`conversionCategory` ASC),
	INDEX `repo_adw_display_keyword_report_conv19` (`conversionTrackerId` ASC),
	INDEX `repo_adw_display_keyword_report_conv20` (`conversionName` ASC),
	INDEX `repo_adw_display_keyword_report_conv21` (`maxCPC` ASC),
	INDEX `repo_adw_display_keyword_report_conv22` (`maxCPCSource` ASC),
	INDEX `repo_adw_display_keyword_report_conv23` (`maxCPM` ASC),
	INDEX `repo_adw_display_keyword_report_conv24` (`maxCPMSource` ASC),
	INDEX `repo_adw_display_keyword_report_conv25` (`maxCPV` ASC),
	INDEX `repo_adw_display_keyword_report_conv26` (`maxCPVSource` ASC),
	INDEX `repo_adw_display_keyword_report_conv27` (`day` ASC),
	INDEX `repo_adw_display_keyword_report_conv28` (`dayOfWeek` ASC),
	INDEX `repo_adw_display_keyword_report_conv29` (`device` ASC),
	INDEX `repo_adw_display_keyword_report_conv30` (`conversionSource` ASC),
	INDEX `repo_adw_display_keyword_report_conv31` (`customerID` ASC),
	INDEX `repo_adw_display_keyword_report_conv32` (`keywordID` ASC),
	INDEX `repo_adw_display_keyword_report_conv33` (`isNegative` ASC),
	INDEX `repo_adw_display_keyword_report_conv34` (`isRestricting` ASC),
	INDEX `repo_adw_display_keyword_report_conv35` (`month` ASC),
	INDEX `repo_adw_display_keyword_report_conv36` (`monthOfYear` ASC),
	INDEX `repo_adw_display_keyword_report_conv37` (`quarter` ASC),
	INDEX `repo_adw_display_keyword_report_conv38` (`week` ASC),
	INDEX `repo_adw_display_keyword_report_conv39` (`year` ASC)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Adwordsディスプレイキーワードレポート（コンバージョン）';
