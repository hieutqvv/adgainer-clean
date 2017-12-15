/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_adw_display_keyword_report_cost
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_adw_display_keyword_report_cost` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`exeDate` DATE NOT NULL COMMENT 'レポートAPI実行日',
	`startDate` DATE NOT NULL COMMENT 'APIで指定したレポートの開始日',
	`endDate` DATE NOT NULL COMMENT 'APIで指定したレポートの終了日',
	`account_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのアカウントID',
	`campaign_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのキャンペーンID。destinationURLのクエリパラメータを分解して取得',
	`currency` VARCHAR(50) NULL COMMENT '顧客アカウントの通貨。',
	`account` TEXT NULL COMMENT 'カスタマーアカウントのわかりやすい名前。',
	`timeZone` VARCHAR(50) NULL COMMENT '顧客アカウント用に選択されたタイムゾーンの名前。たとえば、「（GMT-05：00）東部時間」などです。このフィールドには、タイムゾーンの夏時間の現在の状態は反映されません。',
	`activeViewAvgCPM` Double NULL COMMENT '視認可能インプレッションの平均費用（ActiveViewImpressions）。',
	`activeViewViewableCTR` Double NULL COMMENT '広告が表示された後にユーザーが広告をクリックした頻度',
	`activeViewViewableImpressions` INT(20) NULL COMMENT 'ディスプレイネットワークサイトで広告が表示される頻度',
	`activeViewMeasurableImprImpr` Double NULL COMMENT 'アクティブビューで計測されたインプレッション数と配信済みインプレッション数の比。',
	`activeViewMeasurableCost` Double NULL COMMENT 'Active Viewで測定可能なインプレッションの費用。',
	`activeViewMeasurableImpr` INT(20) NULL COMMENT '広告が表示されているプレースメントに広告が表示された回数。',
	`activeViewViewableImprMeasurableImpr` Double NULL COMMENT '広告がアクティブビュー対応サイトに表示された時間（測定可能なインプレッション数）と表示可能（表示可能なインプレッション数）の割合。',
	`adGroupID` INT(20) NULL COMMENT '広告グループのID。',
	`adGroup` TEXT NULL COMMENT '広告グループの名前。',
	`adGroupState` VARCHAR(50) NULL COMMENT '広告グループのステータス。',
	`network` VARCHAR(50) NULL COMMENT '第1レベルのネットワークタイプ。',
	`networkWithSearchPartners` VARCHAR(50) NULL COMMENT '第2レベルのネットワークタイプ（検索パートナーを含む）。',
	`allConvRate` Double NULL COMMENT 'AllConversionsをコンバージョントラッキングできる合計クリック数で割ったものです。これは、広告のクリックがコンバージョンにつながった頻度です。',
	`allConv` Double NULL COMMENT 'AdWordsが推進するコンバージョン数の最善の見積もり。ウェブサイト、クロスデバイス、電話通話のコンバージョンが含まれます。',
	`allConvValue` Double NULL COMMENT '推定されたものを含む、すべてのコンバージョンの合計値。',
	`avgCost` Double NULL COMMENT 'インタラクションごとに支払う平均金額。この金額は、広告の合計費用を合計インタラクション数で割ったものです。',
	`avgCPC` Double NULL COMMENT 'すべてのクリックの総コストを、受け取った総クリック数で割った値。',
	`avgCPE` Double NULL COMMENT '広告掲載に費やされた平均金額。この金額は、すべての広告契約の総費用を広告契約の総数で割ったものです。',
	`avgCPM` Double NULL COMMENT '平均インプレッション単価（CPM）。',
	`avgCPV` Double NULL COMMENT 'ユーザーが広告を表示するたびに支払う平均金額。平均CPVは、すべての広告ビューの総コストをビュー数で割った値で定義されます。',
	`baseAdGroupID` INT(20) NULL COMMENT '試用広告グループの基本広告グループのID。通常の広告グループの場合、これはAdGroupIdと同じです。',
	`baseCampaignID` INT(20) NULL COMMENT '試用キャンペーンの基本キャンペーンのID。通常のキャンペーンの場合、これはCampaignIdと同じです。',
	`conversionOptimizerBidType` VARCHAR(50) NULL COMMENT '入札タイプ。',
	`campaignID` INT(20) NULL COMMENT 'キャンペーンのID。',
	`campaign` TEXT NULL COMMENT 'キャンペーンの名前。',
	`campaignState` VARCHAR(50) NULL COMMENT 'キャンペーンのステータス。',
	`clicks` INT(20) NULL COMMENT 'クリック数。',
	`convRate` Double NULL COMMENT 'コンバージョン数をコンバージョンにトラッキングできる合計クリック数で割ったものです。',
	`conversions` Double NULL COMMENT '最適化を選択したすべてのコンバージョンアクションのコンバージョン数。',
	`totalConvValue` Double NULL COMMENT 'すべてのコンバージョンのコンバージョン値の合計。',
	`cost` Double NULL COMMENT 'この期間のクリック単価（CPC）とインプレッション単価（CPM）の合計。',
	`costAllConv` Double NULL COMMENT '総費用をすべてのコンバージョンで割った値。',
	`costConv` Double NULL COMMENT 'コンバージョントラッキングクリック数に起因する費用をコンバージョン数で割った値',
	`maxCPC` Double NULL COMMENT 'クリック単価制。値は、a）小額の金額、b）AdWordsが自動的に選択された入札戦略で入札単価を設定する場合は「自動：x」または「自動」、c）クリック単価が適用されない場合は「 - 」のいずれかです',
	`maxCPCSource` VARCHAR(50) NULL COMMENT 'CPC入札のソース。',
	`maxCPM` Double NULL COMMENT 'CPM（1,000インプレッションあたりの単価）の単価',
	`maxCPMSource` VARCHAR(50) NULL COMMENT 'CPM入札のソース。',
	`maxCPV` Double NULL COMMENT '視聴単価制の入札単価値は、a）小額の金額、b）AdWordsが自動的に選択した入札戦略で入札単価を設定している場合は「自動：x」または「自動」、またはc）入札単価が適用されない場合は「 - 」のいずれかです',
	`maxCPVSource` VARCHAR(50) NULL COMMENT '視聴単価の入札価格です。',
	`keyword` TEXT NULL COMMENT 'Criterionの記述的な文字列。レポートの条件タイプのフォーマットの詳細については、条件プレフィックス(URL:https://developers.google.com/adwords/api/docs/guides/reporting#criteria_prefixes)のセクションをご覧ください。',
	`destinationURL` TEXT NULL COMMENT '広告を表示した条件のリンク先URL。',
	`crossDeviceConv` Double NULL COMMENT '顧客が1つの端末でAdWords広告をクリックしてから別の端末やブラウザで変換した後のコンバージョンデバイス間のコンバージョンは既にAllConversions列に含まれています。',
	`ctr` Double NULL COMMENT '広告がクリックされた回数（クリック数）を広告が表示された回数（インプレッション数）で割ったものです。',
	`clientName` TEXT NULL COMMENT 'カスタマーのわかりやすい名前。',
	`day` Date NULL COMMENT '日付はyyyy-MM-ddの形式になります。',
	`dayOfWeek` VARCHAR(50) NULL COMMENT '曜日の名前です（例：「月曜日」）。',
	`device` VARCHAR(50) NULL COMMENT 'インプレッションが表示されたデバイスの種類。',
	`engagementRate` Double NULL COMMENT '広告が表示された後、ユーザーが広告にどのくらいの頻度で関与するか。 広告の表示回数を広告の表示回数で割ったものです。',
	`engagements` INT(20) NULL COMMENT '約束の数。 視聴者がライトボックス広告を展開するとエンゲージメントが発生します。 また、今後、他の広告タイプがエンゲージメント指標をサポートする場合もあります。',
	`customerID` INT(20) NULL COMMENT '顧客ID。',
	`appFinalURL` TEXT NULL COMMENT 'この行のメインオブジェクトの最終的なアプリURLのリスト。リストのエントリは、a）「android-app：」（Androidアプリの場合）またはb）「os-app：」（iOSアプリの場合）のいずれかで始まります。 AppUrlList要素はJSONリスト形式で返されます。',
	`mobileFinalURL` TEXT NULL COMMENT 'この行のメインオブジェクトの最終的なモバイルURLのリスト。 UrlList要素はJSONリスト形式で返されます。',
	`finalURL` TEXT NULL COMMENT 'この行の主要オブジェクトの最終的なURLのリスト。 UrlList要素はJSONリスト形式で返されます。',
	`gmailForwards` INT(20) NULL COMMENT '広告が誰かにメッセージとして転送された回数。',
	`gmailSaves` INT(20) NULL COMMENT 'Gmail広告をメッセージとして受信トレイに保存した回数。',
	`gmailClicksToWebsite` INT(20) NULL COMMENT 'Gmail広告の展開状態でのリンク先ページへのクリック数。',
	`keywordID` INT(20) NULL COMMENT 'この行の主オブジェクトのID。',
	`impressions` INT(20) NULL COMMENT 'Googleネットワークの検索結果ページやウェブサイトに広告が表示された回数をカウントします。',
	`interactionRate` Double NULL COMMENT '広告が表示された後にユーザーがどのくらい頻繁に広告を操作するか。これはインタラクションの数を広告の表示回数で割ったものです。',
	`interactions` INT(20) NULL COMMENT '相互作用の数インタラクションとは、テキストやショッピング広告のクリック、動画広告の表示など、広告フォーマットに関連する主要なユーザーアクションです。',
	`interactionTypes` VARCHAR(50) NULL COMMENT 'Interactions、InteractionRate、およびAverageCost列に反映される相互作用のタイプ。',
	`isNegative` Boolean NULL COMMENT 'この行の基準が否定（除外）基準であるかどうかを示します。',
	`isRestricting` Boolean NULL COMMENT 'trueの値は、基準タイプが入札単価とターゲティング制限に使用されていることを示します。 falseの値は、基準タイプが入札にのみ使用されることを示します。これは、基準の対応するAdGroup.TargetingSettingDetailのtargetAllと反対の値になります。たとえば、criterionTypeGroup = PLACEMENTのTargetingSettingDetailにtargetAll = trueが設定されている場合、IsRestrictフィールドは配置基準に対してfalseになります。',
	`month` Date NULL COMMENT '月の最初の日。yyyy-MM-ddの形式です。',
	`monthOfYear` VARCHAR(50) NULL COMMENT '月の名前です（例：「12月」）。',
	`quarter` Date NULL COMMENT '四半期の最初の日は、yyyy-MM-ddの形式です。四半期の暦年を使用します。たとえば、2014年第2四半期は2014-04-01に開始します。',
	`keywordState` VARCHAR(50) NULL COMMENT 'この行のメインオブジェクトのステータス。たとえば、キャンペーンの掲載結果レポートでは、これが各行のキャンペーンのステータスになります。広告グループの掲載結果レポートでは、これは各行の広告グループのステータスになります。',
	`trackingTemplate` TEXT NULL COMMENT 'この行のメインオブジェクトのトラッキングテンプレート。',
	`customParameter` TEXT NULL COMMENT 'この行のメインオブジェクトのカスタムURLパラメータ。 CustomParameters要素はJSONマップ形式で返されます。',
	`valueAllConv` Double NULL COMMENT 'すべてのコンバージョンの平均値です。',
	`valueConv` Double NULL COMMENT 'コンバージョン数の合計をコンバージョン数で割った値。',
	`videoPlayedTo100` Double NULL COMMENT '視聴者があなたのすべての動画を視聴したインプレッションの割合。',
	`videoPlayedTo25` Double NULL COMMENT '視聴者が動画の25％を視聴したインプレッションの割合。',
	`videoPlayedTo50` Double NULL COMMENT '視聴者が動画の50％を視聴したインプレッションの割合。',
	`videoPlayedTo75` Double NULL COMMENT '視聴者が動画の75％を視聴したインプレッションの割合。',
	`viewRate` Double NULL COMMENT 'TrueView動画広告の表示回数を、TrueViewインディスプレイ広告のサムネイル表示回数を含むインプレッション数で割ったものです。',
	`views` INT(20) NULL COMMENT '動画広告が表示された回数。',
	`viewThroughConv` INT(20) NULL COMMENT 'ビュースルーコンバージョンの合計数。これは、ディスプレイネットワーク広告が表示された後、後で他の広告とやり取り（クリックなど）せずにサイトのコンバージョンを達成した場合に発生します。',
	`week` Date NULL COMMENT 'yyyy-MM-ddの形式の月曜日の日付。',
	`year` INT NULL COMMENT '年はyyyyの形式です。',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id_UNIQUE` (`id` ASC),
	INDEX `repo_adw_display_keyword_report_cost1` (`exeDate` ASC),
	INDEX `repo_adw_display_keyword_report_cost2` (`startDate` ASC),
	INDEX `repo_adw_display_keyword_report_cost3` (`endDate` ASC),
	INDEX `repo_adw_display_keyword_report_cost4` (`account_id` ASC),
	INDEX `repo_adw_display_keyword_report_cost5` (`campaign_id` ASC),
	INDEX `repo_adw_display_keyword_report_cost6` (`currency` ASC),
	INDEX `repo_adw_display_keyword_report_cost7` (`timeZone` ASC),
	INDEX `repo_adw_display_keyword_report_cost8` (`adGroupID` ASC),
	INDEX `repo_adw_display_keyword_report_cost9` (`adGroupState` ASC),
	INDEX `repo_adw_display_keyword_report_cost10` (`network` ASC),
	INDEX `repo_adw_display_keyword_report_cost11` (`networkWithSearchPartners` ASC),
	INDEX `repo_adw_display_keyword_report_cost12` (`baseAdGroupID` ASC),
	INDEX `repo_adw_display_keyword_report_cost13` (`baseCampaignID` ASC),
	INDEX `repo_adw_display_keyword_report_cost14` (`conversionOptimizerBidType` ASC),
	INDEX `repo_adw_display_keyword_report_cost15` (`campaignID` ASC),
	INDEX `repo_adw_display_keyword_report_cost16` (`campaignState` ASC),
	INDEX `repo_adw_display_keyword_report_cost17` (`maxCPC` ASC),
	INDEX `repo_adw_display_keyword_report_cost18` (`maxCPCSource` ASC),
	INDEX `repo_adw_display_keyword_report_cost19` (`maxCPM` ASC),
	INDEX `repo_adw_display_keyword_report_cost20` (`maxCPMSource` ASC),
	INDEX `repo_adw_display_keyword_report_cost21` (`maxCPV` ASC),
	INDEX `repo_adw_display_keyword_report_cost22` (`maxCPVSource` ASC),
	INDEX `repo_adw_display_keyword_report_cost23` (`day` ASC),
	INDEX `repo_adw_display_keyword_report_cost24` (`dayOfWeek` ASC),
	INDEX `repo_adw_display_keyword_report_cost25` (`device` ASC),
	INDEX `repo_adw_display_keyword_report_cost26` (`customerID` ASC),
	INDEX `repo_adw_display_keyword_report_cost27` (`keywordID` ASC),
	INDEX `repo_adw_display_keyword_report_cost28` (`isNegative` ASC),
	INDEX `repo_adw_display_keyword_report_cost29` (`isRestricting` ASC),
	INDEX `repo_adw_display_keyword_report_cost30` (`month` ASC),
	INDEX `repo_adw_display_keyword_report_cost31` (`monthOfYear` ASC),
	INDEX `repo_adw_display_keyword_report_cost32` (`quarter` ASC),
	INDEX `repo_adw_display_keyword_report_cost33` (`keywordState` ASC),
	INDEX `repo_adw_display_keyword_report_cost34` (`week` ASC),
	INDEX `repo_adw_display_keyword_report_cost35` (`year` ASC)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Adwordsディスプレイキーワードレポート（コスト）';
