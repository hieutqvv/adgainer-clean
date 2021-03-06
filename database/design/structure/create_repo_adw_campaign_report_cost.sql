/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_adw_campaign_report_cost
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_adw_campaign_report_cost` (
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
	`activeViewMeasurableImprImpr` Double NULL COMMENT 'アクティブビューで計測されたインプレッション数と配信インプレッション数の比。',
	`activeViewMeasurableCost` Double NULL COMMENT 'Active Viewで測定可能なインプレッションの費用。',
	`activeViewMeasurableImpr` INT(20) NULL COMMENT '広告が表示されているプレースメントに広告が表示された回数。',
	`activeViewViewableImprMeasurableImpr` Double NULL COMMENT '広告がアクティブビュー対応サイトに表示された時間（測定可能なインプレッション数）と表示可能（表示可能なインプレッション数）の割合。',
	`network` VARCHAR(50) NULL COMMENT '第1レベルのネットワークタイプ。',
	`networkWithSearchPartners` VARCHAR(50) NULL COMMENT '第2レベルのネットワークタイプ（検索パートナーを含む）。',
	`advertisingSubChannel` VARCHAR(50) NULL COMMENT 'キャンペーンのAdvertisingChannelTypeのオプションの細分化。',
	`advertisingChannel` VARCHAR(50) NULL COMMENT 'キャンペーン内の広告の主要な配信ターゲット。',
	`budget` Double NULL COMMENT '1日の予算。キャンペーンの掲載結果レポートには、キャンペーンが共有予算から引き出された場合の共有予算全体が反映されます。',
	`avgCost` Double NULL COMMENT 'インタラクションごとに支払う平均金額。この金額は、広告の合計費用を合計インタラクション数で割ったものです。',
	`avgCPC` Double NULL COMMENT 'すべてのクリックの総コストを、受け取った総クリック数で割った値。',
	`avgCPE` Double NULL COMMENT '広告掲載に費やされた平均金額。この金額は、すべての広告契約の総費用を広告契約の総数で割ったものです。',
	`avgCPM` Double NULL COMMENT '平均インプレッション単価（CPM）。',
	`avgCPV` Double NULL COMMENT 'ユーザーが広告を表示するたびに支払う平均金額。平均CPVは、すべての広告ビューの総コストをビュー数で割った値で定義されます。',
	`avgPosition` Double NULL COMMENT '他の広告主様との相対的な広告の掲載順位。',
	`baseCampaignID` INT(20) NULL COMMENT '試用キャンペーンの基本キャンペーンのID。通常のキャンペーンの場合、これはCampaignIdと同じです。',
	`bidStrategyID` INT(20) NULL COMMENT 'BiddingStrategyConfigurationのIDです。',
	`bidStrategyName` TEXT NULL COMMENT 'BiddingStrategyConfigurationの名前。',
	`bidStrategyType` VARCHAR(50) NULL COMMENT 'BiddingStrategyConfigurationのタイプ。',
	`conversionOptimizerBidType` VARCHAR(50) NULL COMMENT '入札タイプ。',
	`budgetID` INT(20) NULL COMMENT '予算のID。',
	`desktopBidAdj` Double NULL COMMENT 'キャンペーンのレベルでデスクトップの入札単価調整が上書きされます。',
	`campaignGroupID` INT(20) NULL COMMENT 'キャンペーングループのID。',
	`campaignID` INT(20) NULL COMMENT 'キャンペーンのID。',
	`mobileBidAdj` Double NULL COMMENT 'キャンペーンのモバイル入札単価調整機能。このフィールドでフィルタリングするには、0より大きく1以下の値を使用します。',
	`campaign` TEXT NULL COMMENT 'キャンペーンの名前。',
	`campaignState` VARCHAR(50) NULL COMMENT 'キャンペーンのステータス。',
	`tabletBidAdj` Double NULL COMMENT 'キャンペーンレベルでタブレットの入札単価調整が上書きされます。',
	`campaignTrialType` VARCHAR(50) NULL COMMENT 'キャンペーンのタイプ。これは、キャンペーンが試用キャンペーンかどうかを示します。',
	`clicks` INT(20) NULL COMMENT 'クリック数。',
	`contentLostISBudget` Double NULL COMMENT '広告がディスプレイネットワークに表示されていたものの、予算が低すぎたためではなかった推定回数。',
	`contentImprShare` Double NULL COMMENT 'ディスプレイネットワークで獲得したインプレッションを、表示された推定インプレッション数で割ったものです。',
	`contentLostISRank` Double NULL COMMENT '広告ランクが低いために広告が表示されなかったディスプレイネットワークのインプレッションの推定割合。',
	`convRate` Double NULL COMMENT 'コンバージョン数をコンバージョンにトラッキングできる合計クリック数で割ったものです。',
	`conversions` Double NULL COMMENT '最適化を選択したすべてのコンバージョンアクションのコンバージョン数です。',
	`totalConvValue` Double NULL COMMENT 'すべてのコンバージョンのコンバージョン値の合計。',
	`cost` Double NULL COMMENT 'この期間のクリック単価（CPC）とインプレッション単価（CPM）の合計。',
	`costConv` Double NULL COMMENT 'コンバージョントラッキングクリック数をコンバージョン数で割った値です。',
	`costConvCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで過去のCostPerConversionデータがどのように表示されるかを示します。',
	`ctr` Double NULL COMMENT '広告がクリックされた回数（クリック数）を広告が表示された回数（インプレッション数）で割ったものです。',
	`conversionsCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルでコンバージョンデータがどのように表示されるかを示します。',
	`convValueCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで過去のConversionValueデータがどのように表示されるかを示します。',
	`clientName` TEXT NULL COMMENT 'カスタマーのわかりやすい名前。',
	`day` Date NULL COMMENT '日付はyyyy-MM-ddの形式になります。',
	`dayOfWeek` VARCHAR(50) NULL COMMENT '曜日の名前です（例：「月曜日」）。',
	`device` VARCHAR(50) NULL COMMENT 'インプレッションが表示されたデバイスの種類。',
	`campaignEndDate` Date NULL COMMENT 'キャンペーンの終了日。yyyy-MM-ddとしてフォーマットされています。',
	`engagementRate` Double NULL COMMENT '広告が表示された後、ユーザーが広告にどのくらいの頻度で関与するか。広告の表示回数を広告の表示回数で割ったものです。',
	`engagements` INT(20) NULL COMMENT '約束の数。視聴者がライトボックス広告を展開するとエンゲージメントが発生します。また、今後、他の広告タイプがエンゲージメント指標をサポートする場合もあります。',
	`enhancedCPCEnabled` Boolean NULL COMMENT '入札戦略でエンハンストCPCが有効になっているかどうかを示します。',
	`enhancedCPVEnabled` Boolean NULL COMMENT '入札戦略でエンハンストCPVが有効になっているかどうかを示します。',
	`customerID` INT(20) NULL COMMENT '顧客ID。',
	`gmailForwards` INT(20) NULL COMMENT '広告が誰かにメッセージとして転送された回数。',
	`gmailSaves` INT(20) NULL COMMENT 'Gmail広告をメッセージとして受信トレイに保存した回数。',
	`gmailClicksToWebsite` INT(20) NULL COMMENT 'Gmail広告の展開状態でのリンク先ページへのクリック数。',
	`hourOfDay` INT NULL COMMENT '1日の時間は0と23の間の数値です。',
	`impressions` INT(20) NULL COMMENT 'Googleネットワークの検索結果ページやウェブサイトに広告が表示された回数をカウントします。',
	`interactionRate` Double NULL COMMENT '広告が表示された後にユーザーがどのくらい頻繁に広告を操作するか。これはインタラクションの数を広告の表示回数で割ったものです。',
	`interactions` INT(20) NULL COMMENT '相互作用の数インタラクションとは、テキストやショッピング広告のクリック、動画広告の表示など、広告フォーマットに関連する主要なユーザーアクションです。',
	`interactionTypes` VARCHAR(50) NULL COMMENT 'Interactions、InteractionRate、およびAverageCost列に反映される相互作用のタイプ。',
	`budgetExplicitlyShared` Boolean NULL COMMENT '予算が共有予算（true）かキャンペーン固有（false）かを示します。',
	`labelIDs` TEXT NULL COMMENT 'この行の主オブジェクトのラベルIDのリスト。リスト要素はJSONリスト形式で返されます。',
	`labels` TEXT NULL COMMENT 'この行のメインオブジェクトのラベル名のリスト。リスト要素はJSONリスト形式で返されます。',
	`month` Date NULL COMMENT '月の最初の日。yyyy-MM-ddとしてフォーマットされています。',
	`monthOfYear` VARCHAR(50) NULL COMMENT '月の名前です（例：「December」）。',
	`budgetPeriod` VARCHAR(50) NULL COMMENT '予算を費やす期間。',
	`quarter` Date NULL COMMENT '四半期の最初の日は、yyyy-MM-ddの形式です。四半期の暦年を使用します。たとえば、2014年の第2四半期は2014-04-01に始まります。',
	`searchLostISBudget` Double NULL COMMENT '広告が検索ネットワークに表示されていたものの、予算が低すぎたためではなかった推定割合。',
	`searchExactMatchIS` Double NULL COMMENT '受け取ったインプレッションを、キーワードマッチタイプに関係なく、キーワードと正確に一致する検索語（またはキーワードの類似したもの）で、検索ネットワークで表示される見込みインプレッション数で割ったものです。',
	`searchImprShare` Double NULL COMMENT '検索ネットワークで受け取ったインプレッションを、表示された推定インプレッション数で割ったものです。',
	`searchLostISRank` Double NULL COMMENT '広告ランクが低いために広告が表示されなかった検索ネットワークのインプレッションの推定パーセンテージ。 ',
	`campaignServingStatus` VARCHAR(50) NULL COMMENT 'キャンペーンが広告を配信しているかどうかを示します。',
	`campaignStartDate` Date NULL COMMENT 'キャンペーンの開始日。yyyy-MM-ddとしてフォーマットされています',
	`trackingTemplate` TEXT NULL COMMENT 'この行のメインオブジェクトのトラッキングテンプレート。',
	`customParameter` TEXT NULL COMMENT 'この行のメインオブジェクトのカスタムURLパラメータ。CustomParameters要素はJSONマップ形式で返されます。',
	`valueConv` Double NULL COMMENT 'コンバージョン数の合計をコンバージョン数で割った値。',
	`valueConvCurrentModel` Double NULL COMMENT 'ValuePerConversionの過去のデータが現在選択しているアトリビューションモデルでどのように表示されるかを示します。',
	`videoPlayedTo100` Double NULL COMMENT '視聴者があなたのすべての動画を視聴したインプレッションの割合。',
	`videoPlayedTo25` Double NULL COMMENT '視聴者が動画の25％を視聴したインプレッションの割合。',
	`videoPlayedTo50` Double NULL COMMENT '視聴者が動画の50％を視聴したインプレッションの割合。',
	`videoPlayedTo75` Double NULL COMMENT '視聴者が動画の75％を視聴したインプレッションの割合。',
	`viewRate` Double NULL COMMENT 'TrueView動画広告の表示回数を、TrueViewインディスプレイ広告のサムネイル表示回数を含むインプレッション数で割ったものです。',
	`views` INT(20) NULL COMMENT '動画広告が表示された回数。',
	`viewThroughConv` INT(20) NULL COMMENT '"ビュースルーコンバージョンの合計数。
	これは、ディスプレイネットワーク広告が表示された後、後で他の広告とやり取り（クリックなど）せずにサイトのコンバージョンを達成した場合に発生します。"',
	`week` Date NULL COMMENT '月曜日の日付。yyyy-MM-ddとしてフォーマットされています。',
	`year` INT NULL COMMENT '年はyyyyの形式です。',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id_UNIQUE` (`id` ASC),
	INDEX `repo_adw_campaign_report_cost1` (`exeDate` ASC),
	INDEX `repo_adw_campaign_report_cost2` (`startDate` ASC),
	INDEX `repo_adw_campaign_report_cost3` (`endDate` ASC),
	INDEX `repo_adw_campaign_report_cost4` (`account_id` ASC),
	INDEX `repo_adw_campaign_report_cost5` (`campaign_id` ASC),
	INDEX `repo_adw_campaign_report_cost6` (`currency` ASC),
	INDEX `repo_adw_campaign_report_cost7` (`timeZone` ASC),
	INDEX `repo_adw_campaign_report_cost8` (`network` ASC),
	INDEX `repo_adw_campaign_report_cost9` (`networkWithSearchPartners` ASC),
	INDEX `repo_adw_campaign_report_cost10` (`advertisingSubChannel` ASC),
	INDEX `repo_adw_campaign_report_cost11` (`advertisingChannel` ASC),
	INDEX `repo_adw_campaign_report_cost12` (`budget` ASC),
	INDEX `repo_adw_campaign_report_cost13` (`baseCampaignID` ASC),
	INDEX `repo_adw_campaign_report_cost14` (`bidStrategyID` ASC),
	INDEX `repo_adw_campaign_report_cost15` (`bidStrategyType` ASC),
	INDEX `repo_adw_campaign_report_cost16` (`conversionOptimizerBidType` ASC),
	INDEX `repo_adw_campaign_report_cost17` (`budgetID` ASC),
	INDEX `repo_adw_campaign_report_cost18` (`desktopBidAdj` ASC),
	INDEX `repo_adw_campaign_report_cost19` (`campaignGroupID` ASC),
	INDEX `repo_adw_campaign_report_cost20` (`campaignID` ASC),
	INDEX `repo_adw_campaign_report_cost21` (`mobileBidAdj` ASC),
	INDEX `repo_adw_campaign_report_cost22` (`campaignState` ASC),
	INDEX `repo_adw_campaign_report_cost23` (`tabletBidAdj` ASC),
	INDEX `repo_adw_campaign_report_cost24` (`campaignTrialType` ASC),
	INDEX `repo_adw_campaign_report_cost25` (`day` ASC),
	INDEX `repo_adw_campaign_report_cost26` (`dayOfWeek` ASC),
	INDEX `repo_adw_campaign_report_cost27` (`device` ASC),
	INDEX `repo_adw_campaign_report_cost28` (`campaignEndDate` ASC),
	INDEX `repo_adw_campaign_report_cost29` (`enhancedCPCEnabled` ASC),
	INDEX `repo_adw_campaign_report_cost30` (`enhancedCPVEnabled` ASC),
	INDEX `repo_adw_campaign_report_cost31` (`customerID` ASC),
	INDEX `repo_adw_campaign_report_cost32` (`hourOfDay` ASC),
	INDEX `repo_adw_campaign_report_cost33` (`budgetExplicitlyShared` ASC),
	INDEX `repo_adw_campaign_report_cost34` (`month` ASC),
	INDEX `repo_adw_campaign_report_cost35` (`monthOfYear` ASC),
	INDEX `repo_adw_campaign_report_cost36` (`budgetPeriod` ASC),
	INDEX `repo_adw_campaign_report_cost37` (`quarter` ASC),
	INDEX `repo_adw_campaign_report_cost38` (`campaignServingStatus` ASC),
	INDEX `repo_adw_campaign_report_cost39` (`campaignStartDate` ASC),
	INDEX `repo_adw_campaign_report_cost40` (`week` ASC),
	INDEX `repo_adw_campaign_report_cost41` (`year` ASC)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Adwordsキャンペーンレポート（コスト）';
