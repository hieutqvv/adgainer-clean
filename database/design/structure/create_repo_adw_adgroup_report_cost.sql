/**
 * ADgaienr Solutions Reporting System
 * Schema : ADGAINER_db_SECURE
 * Table Name : repo_adw_adgroup_report_cost
 * Auther : Tetsuya Takiguchi
 */
CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_adw_adgroup_report_cost` (
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
	`desktopBidAdj` Double NULL COMMENT '広告グループレベルでデスクトップの入札単価調整が上書きされます。',
	`adGroupID` INT(20) NULL COMMENT '広告グループのID。',
	`mobileBidAdj` Double NULL COMMENT '広告グループレベルでモバイルの入札単価調整が上書きされます。',
	`adGroup` TEXT NULL COMMENT '広告グループの名前。',
	`adGroupState` VARCHAR(50) NULL COMMENT '広告グループのステータス。',
	`tabletBidAdj` Double NULL COMMENT 'タブグループの入札単価調整が広告グループレベルでオーバーライドされます。',
	`adGroupType` VARCHAR(50) NULL COMMENT '広告グループのタイプ。',
	`network` VARCHAR(50) NULL COMMENT '第1レベルのネットワークタイプ。',
	`networkWithSearchPartners` VARCHAR(50) NULL COMMENT '第2レベルのネットワークタイプ（検索パートナーを含む）。',
	`avgCost` Double NULL COMMENT 'インタラクションごとに支払う平均金額。この金額は、広告の合計費用を合計インタラクション数で割ったものです。',
	`avgCPC` Double NULL COMMENT 'すべてのクリックの総コストを、受け取った総クリック数で割った値。',
	`avgCPE` Double NULL COMMENT '広告掲載に費やされた平均金額。この金額は、すべての広告契約の総費用を広告契約の総数で割ったものです。',
	`avgCPM` Double NULL COMMENT '平均インプレッション単価（CPM）。',
	`avgCPV` Double NULL COMMENT 'ユーザーが広告を表示するたびに支払う平均金額。平均CPVは、すべての広告ビューの総コストをビュー数で割った値で定義されます。',
	`avgPosition` Double NULL COMMENT '他の広告主様との相対的な広告の掲載順位',
	`baseAdGroupID` INT(20) NULL COMMENT '試用広告グループの基本広告グループのID。通常の広告グループの場合、これはAdGroupIdと同じです。',
	`baseCampaignID` INT(20) NULL COMMENT '試用キャンペーンの基本キャンペーンのID。通常のキャンペーンの場合、これはCampaignIdと同じです。',
	`bidStrategyID` INT(20) NULL COMMENT 'BiddingStrategyConfigurationのIDです。',
	`bidStrategyName` TEXT NULL COMMENT 'BiddingStrategyConfigurationの名前。',
	`biddingStrategySource` VARCHAR(50) NULL COMMENT '入札戦略が関連付けられている場所（キャンペーン、広告グループ、広告グループの条件など）を示します。',
	`bidStrategyType` VARCHAR(50) NULL COMMENT 'BiddingStrategyConfigurationのタイプ。',
	`conversionOptimizerBidType` VARCHAR(50) NULL COMMENT '入札タイプ。',
	`campaignID` INT(20) NULL COMMENT 'キャンペーンのID。',
	`campaign` TEXT NULL COMMENT 'キャンペーンの名前。',
	`campaignState` VARCHAR(50) NULL COMMENT 'キャンペーンのステータス。',
	`clicks` INT(20) NULL COMMENT 'クリック数。',
	`contentNetworkBidDimension` VARCHAR(50) NULL COMMENT '広告グループでディスプレイネットワークの絶対的な入札単価に使用する条件のタイプ。',
	`contentImprShare` Double NULL COMMENT 'ディスプレイネットワークで獲得したインプレッション数を、表示された推定インプレッション数で割ったものです。',
	`contentLostISRank` Double NULL COMMENT '広告ランクが低いために広告が表示されなかったディスプレイネットワークのインプレッションの推定割合。',
	`convRate` Double NULL COMMENT 'コンバージョン数をコンバージョンにトラッキングできる合計クリック数で割ったものです。 ',
	`conversions` Double NULL COMMENT '最適化を選択したすべてのコンバージョンアクションのコンバージョン数。',
	`totalConvValue` Double NULL COMMENT 'すべてのコンバージョンのコンバージョン値の合計。',
	`cost` Double NULL COMMENT 'この期間のクリック単価（CPC）とインプレッション単価（CPM）の合計。',
	`costConvCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで、過去の「CostPerConversion」データがどのように表示されるかを示します。',
	`defaultMaxCPC` Double NULL COMMENT 'クリック単価制。値は、a）小額の金額、b）AdWordsが自動的に選択された入札戦略で入札単価を設定する場合は「自動：x」または「自動」、c）クリック単価が適用されない場合は「 - 」のいずれかです行に',
	`maxCPM` Double NULL COMMENT 'CPM（1,000インプレッションあたりの単価）の単価',
	`maxCPV` Double NULL COMMENT '視聴単価制の入札単価値は、a）小額の金額、b）AdWordsが自動的に選択した入札戦略で入札単価を設定している場合は「自動：x」または「自動」、またはc）入札単価が適用されない場合は「 - 」のいずれかです',
	`ctr` Double NULL COMMENT '広告がクリックされた回数（クリック数）を広告が表示された回数（インプレッション数）で割ったものです。 ',
	`conversionsCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルでの過去の「コンバージョン」データの表示方法を示します。',
	`convValueCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで、過去の「ConversionValue」データがどのように表示されるかを示します。',
	`clientName` TEXT NULL COMMENT 'カスタマーのわかりやすい名前。',
	`day` Date NULL COMMENT '日付はyyyy-MM-ddの形式になります。',
	`dayOfWeek` VARCHAR(50) NULL COMMENT '曜日の名前です（例：「月曜日」）。',
	`device` VARCHAR(50) NULL COMMENT 'インプレッションが表示されたデバイスの種類。',
	`targetROAS` Double NULL COMMENT '効果的なターゲット広告費用対効果、オーバーライドを考慮します。',
	`targetROASSource` VARCHAR(50) NULL COMMENT 'オーバーライドを考慮して、効果的な目標のROASのソース。',
	`engagementRate` Double NULL COMMENT '広告が表示された後、ユーザーが広告にどのくらいの頻度で関与するか。 広告の表示回数を広告の表示回数で割ったものです。 ',
	`engagements` INT(20) NULL COMMENT '約束の数。 視聴者がライトボックス広告を展開するとエンゲージメントが発生します。 また、今後、他の広告タイプがエンゲージメント指標をサポートする場合もあります。',
	`enhancedCPCEnabled` VARCHAR(50) NULL COMMENT '入札戦略でエンハンストCPCが有効になっているかどうかを示します。',
	`enhancedCPVEnabled` VARCHAR(50) NULL COMMENT '入札戦略でエンハンストCPVが有効になっているかどうかを示します。',
	`customerID` INT(20) NULL COMMENT '顧客ID。',
	`gmailForwards` INT(20) NULL COMMENT '広告が誰かにメッセージとして転送された回数。',
	`gmailSaves` INT(20) NULL COMMENT 'Gmail広告をメッセージとして受信トレイに保存した回数。',
	`gmailClicksToWebsite` INT(20) NULL COMMENT 'Gmail広告の展開状態でのリンク先ページへのクリック数。',
	`hourOfDay` INT NULL COMMENT '1日の時間は0と23の間の数値です。',
	`impressions` INT(20) NULL COMMENT 'Googleネットワークの検索結果ページやウェブサイトに広告が表示された回数をカウントします。',
	`interactionRate` Double NULL COMMENT '広告が表示された後にユーザーがどのくらい頻繁に広告を操作するか。これはインタラクションの数を広告の表示回数で割ったものです。 ',
	`interactions` INT(20) NULL COMMENT '相互作用の数 インタラクションとは、テキストやショッピング広告のクリック、動画広告の表示など、広告フォーマットに関連する主要なユーザーアクションです。',
	`interactionTypes` VARCHAR(50) NULL COMMENT 'Interactions、InteractionRate、およびAverageCostの各列に反映される相互作用のタイプ。',
	`labelIDs` TEXT NULL COMMENT 'この行のメインオブジェクトのラベルIDのリスト。リスト要素はJSONリスト形式で返されます。',
	`labels` TEXT NULL COMMENT 'この行のメインオブジェクトのラベル名のリスト。リスト要素はJSONリスト形式で返されます。',
	`month` Date NULL COMMENT '月の最初の日。yyyy-MM-ddの形式です。',
	`monthOfYear` VARCHAR(50) NULL COMMENT '月の名前です（例：「12月」）。',
	`quarter` Date NULL COMMENT '四半期の最初の日は、yyyy-MM-ddの形式です。四半期の暦年を使用します。たとえば、2014年第2四半期は2014-04-01に開始します。',
	`searchExactMatchIS` Double NULL COMMENT '受け取ったインプレッションを、キーワードマッチタイプに関係なく、キーワードと正確に一致する検索語（またはキーワードの類似したもの）で、検索ネットワークで表示される見込みインプレッション数で割ったものです。',
	`searchImprShare` Double NULL COMMENT '検索ネットワークで受け取ったインプレッションを、表示された推定インプレッション数で割ったものです。',
	`searchLostISRank` Double NULL COMMENT '広告ランクが低いために広告が表示されなかった検索ネットワークのインプレッションの推定パーセンテージ。',
	`targetCPA` Double NULL COMMENT 'ターゲットコンバージョン単価の入札戦略で設定された平均コンバージョン単価ターゲット。',
	`targetCPASource` VARCHAR(50) NULL COMMENT '目標コンバージョン単価が設定されたレベル。 これは広告グループレベルでのみ適用されます。',
	`trackingTemplate` TEXT NULL COMMENT 'この行のメインオブジェクトのトラッキングテンプレート。',
	`customParameter` TEXT NULL COMMENT 'この行のメインオブジェクトのカスタムURLパラメータ。 CustomParameters要素はJSONマップ形式で返されます。',
	`valueConv` Double NULL COMMENT 'コンバージョン数の合計をコンバージョン数で割った値。 このフィールドは、小数点の区切り文字としてドット（"."）でフォーマットされます（例：1000000.00）。',
	`valueConvCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで、過去の「ValuePerConversion」データがどのように表示されるかを示します。',
	`videoPlayedTo100` Double NULL COMMENT '視聴者があなたのすべての動画を視聴したインプレッションの割合。 ',
	`videoPlayedTo25` Double NULL COMMENT '視聴者が動画の25％を視聴したインプレッションの割合。 ',
	`videoPlayedTo50` Double NULL COMMENT '視聴者が動画の50％を視聴したインプレッションの割合。 ',
	`videoPlayedTo75` Double NULL COMMENT '視聴者が動画の75％を視聴したインプレッションの割合。 ',
	`viewRate` Double NULL COMMENT 'TrueView動画広告の表示回数を、TrueViewインディスプレイ広告のサムネイル表示回数を含むインプレッション数で割ったものです。 ',
	`views` INT(20) NULL COMMENT '動画広告が表示された回数。',
	`viewThroughConv` INT(20) NULL COMMENT 'ビュースルーコンバージョンの合計数。これは、ディスプレイネットワーク広告が表示された後、後で他の広告とやり取り（クリックなど）せずにサイトのコンバージョンを達成した場合に発生します。このフィールドは、米国のロケールを使用してフォーマットされています。つまり、3桁区切り「,」、小数点区切りは「.」を使用しています。',
	`week` Date NULL COMMENT 'yyyy-MM-ddの形式の月曜日の日付。',
	`year` INT NULL COMMENT '年はyyyyの形式です。',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id_UNIQUE` (`id` ASC),
	INDEX `repo_adw_adgroup_report_cost1` (`exeDate` ASC),
	INDEX `repo_adw_adgroup_report_cost2` (`startDate` ASC),
	INDEX `repo_adw_adgroup_report_cost3` (`endDate` ASC),
	INDEX `repo_adw_adgroup_report_cost4` (`account_id` ASC),
	INDEX `repo_adw_adgroup_report_cost5` (`campaign_id` ASC),
	INDEX `repo_adw_adgroup_report_cost6` (`currency` ASC),
	INDEX `repo_adw_adgroup_report_cost7` (`timeZone` ASC),
	INDEX `repo_adw_adgroup_report_cost8` (`desktopBidAdj` ASC),
	INDEX `repo_adw_adgroup_report_cost9` (`adGroupID` ASC),
	INDEX `repo_adw_adgroup_report_cost10` (`mobileBidAdj` ASC),
	INDEX `repo_adw_adgroup_report_cost11` (`adGroupState` ASC),
	INDEX `repo_adw_adgroup_report_cost12` (`tabletBidAdj` ASC),
	INDEX `repo_adw_adgroup_report_cost13` (`adGroupType` ASC),
	INDEX `repo_adw_adgroup_report_cost14` (`network` ASC),
	INDEX `repo_adw_adgroup_report_cost15` (`networkWithSearchPartners` ASC),
	INDEX `repo_adw_adgroup_report_cost16` (`baseAdGroupID` ASC),
	INDEX `repo_adw_adgroup_report_cost17` (`baseCampaignID` ASC),
	INDEX `repo_adw_adgroup_report_cost18` (`bidStrategyID` ASC),
	INDEX `repo_adw_adgroup_report_cost19` (`biddingStrategySource` ASC),
	INDEX `repo_adw_adgroup_report_cost20` (`bidStrategyType` ASC),
	INDEX `repo_adw_adgroup_report_cost21` (`conversionOptimizerBidType` ASC),
	INDEX `repo_adw_adgroup_report_cost22` (`campaignID` ASC),
	INDEX `repo_adw_adgroup_report_cost23` (`campaignState` ASC),
	INDEX `repo_adw_adgroup_report_cost24` (`contentNetworkBidDimension` ASC),
	INDEX `repo_adw_adgroup_report_cost25` (`defaultMaxCPC` ASC),
	INDEX `repo_adw_adgroup_report_cost26` (`maxCPM` ASC),
	INDEX `repo_adw_adgroup_report_cost27` (`maxCPV` ASC),
	INDEX `repo_adw_adgroup_report_cost28` (`day` ASC),
	INDEX `repo_adw_adgroup_report_cost29` (`dayOfWeek` ASC),
	INDEX `repo_adw_adgroup_report_cost30` (`device` ASC),
	INDEX `repo_adw_adgroup_report_cost31` (`targetROAS` ASC),
	INDEX `repo_adw_adgroup_report_cost32` (`targetROASSource` ASC),
	INDEX `repo_adw_adgroup_report_cost33` (`enhancedCPCEnabled` ASC),
	INDEX `repo_adw_adgroup_report_cost34` (`enhancedCPVEnabled` ASC),
	INDEX `repo_adw_adgroup_report_cost35` (`customerID` ASC),
	INDEX `repo_adw_adgroup_report_cost36` (`hourOfDay` ASC),
	INDEX `repo_adw_adgroup_report_cost37` (`month` ASC),
	INDEX `repo_adw_adgroup_report_cost38` (`monthOfYear` ASC),
	INDEX `repo_adw_adgroup_report_cost39` (`quarter` ASC),
	INDEX `repo_adw_adgroup_report_cost40` (`targetCPA` ASC),
	INDEX `repo_adw_adgroup_report_cost41` (`targetCPASource` ASC),
	INDEX `repo_adw_adgroup_report_cost42` (`week` ASC),
	INDEX `repo_adw_adgroup_report_cost43` (`year` ASC)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Adwords広告グループレポート（コスト）';