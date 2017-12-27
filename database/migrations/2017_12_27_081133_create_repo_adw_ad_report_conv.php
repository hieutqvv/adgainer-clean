<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// @codingStandardsIgnoreLine
class CreateRepoAdwAdReportConv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE TABLE IF NOT EXISTS `ADGAINER_db_SECURE`.`repo_adw_ad_report_conv` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `exeDate` DATE NOT NULL COMMENT 'レポートAPI実行日',
                `startDate` DATE NOT NULL COMMENT 'APIで指定したレポートの開始日',
                `endDate` DATE NOT NULL COMMENT 'APIで指定したレポートの終了日',
                `account_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのアカウントID',
                `campaign_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのキャンペーンID。destinationURLのクエリパラメータを分解して取得',
                `accentColorResponsive` VARCHAR(50) NULL COMMENT 'レスポンシブディスプレイ広告のアクセントカラー。',
                `currency` VARCHAR(50) NULL COMMENT '顧客口座の通貨。',
                `account` TEXT NULL COMMENT 'カスタマーアカウントのわかりやすい名前。',
                `timeZone` VARCHAR(50) NULL COMMENT '顧客アカウント用に選択されたタイムゾーンの名前。 
                たとえば、「（GMT-05：00）東部時間」などです。 このフィールドには、タイムゾーンの夏時間の現在の状態は反映されません。',
                `adGroupID` INT(20) NULL COMMENT '広告グループのID。',
                `adGroup` TEXT NULL COMMENT '広告グループの名前。',
                `adGroupState` VARCHAR(50) NULL COMMENT '広告グループのステータス。',
                `network` VARCHAR(50) NULL COMMENT '第1レベルのネットワークタイプ。',
                `networkWithSearchPartners` VARCHAR(50) NULL COMMENT '第2レベルのネットワークタイプ（検索パートナーを含む）。',
                `adType` VARCHAR(50) NULL COMMENT '広告のタイプ。広告のタイプがレポートリクエストのAPIバージョン
                でサポートされていない場合、このフィールドの値は「不明」になります。',
                `allConvRate` Double NULL COMMENT 'AllConversionsをコンバージョントラッキングできる合計クリ
                ック数で割ったものです。これは、広告のクリックがコンバージョンにつながった頻度です。 ',
                `allConv` Double NULL COMMENT 'AdWordsが推進するコンバージョン数の最善の見積もり。ウェブサイト、クロスデバイス、電話通話のコンバージョンが含まれます。',
                `allConvValue` Double NULL COMMENT '推定されたものを含む、すべてのコンバージョンの合計値。',
                `allowFlexibleColorResponsive` Boolean NULL COMMENT '応答性の高いディスプレイ広告の色を厳密に使用する必要があるかどうか。',
                `baseAdGroupID` INT(20) NULL COMMENT '試用広告グループの基本広告グループのID。通常の広告グループの場合、これはAdGroupIdと同じです。',
                `baseCampaignID` INT(20) NULL COMMENT '試用キャンペーンの基本キャンペーンのID。通常のキャンペーンの場合、これはCampaignIdと同じです。',
                `businessName` TEXT NULL COMMENT '反応性の高いディスプレイ広告のビジネス名。',
                `callOnlyAdPhoneNumber` VARCHAR(50) NULL COMMENT '通話専用広告の電話番号。',
                `callToActionTextResponsive` VARCHAR(255) NULL COMMENT '反応性ディスプレイ広告の行動を促すフレーズ。',
                `campaignID` INT(20) NULL COMMENT 'キャンペーンのID。',
                `campaign` TEXT NULL COMMENT 'キャンペーンの名前。',
                `campaignState` VARCHAR(50) NULL COMMENT 'キャンペーンのステータス。',
                `clickType` VARCHAR(50) NULL COMMENT '[インプレッション数]フィールドには、そのクリックタイプで広告が配信された頻度が反映されます。 
                広告は複数のクリックタイプで表示できるため、インプレッション数は2倍になり、合計が正確でない可能性があります。',
                `approvalStatus` VARCHAR(50) NULL COMMENT 'レビューステートとステータスを組み合わせた承認ステータス。',
                `conversionCategory` VARCHAR(255) NULL COMMENT 'ユーザーがコンバージョンを達成するために実行す
                るアクションを表すカテゴリ。ゼロ変換の行が返されないようにします。値：「ダウンロード」、「リード」、
                「購入/販売」、「サインアップ」、「キーページの表示」、「その他」の値。',
                `convRate` Double NULL COMMENT 'コンバージョン数をコンバージョンにトラッキングできる合計クリック数で割ったものです。 ',
                `conversions` Double NULL COMMENT '最適化を選択したすべてのコンバージョンアクションのコンバージョン数。',
                `conversionTrackerId` INT(20) NULL COMMENT 'コンバージョントラッカーのID。',
                `conversionName` VARCHAR(255) NULL COMMENT 'コンバージョンタイプの名前。ゼロ変換の行が返されないようにします。',
                `totalConvValue` Double NULL COMMENT 'すべてのコンバージョンのコンバージョン値の合計。',
                `costAllConv` Double NULL COMMENT '総費用をすべてのコンバージョンで割った値。',
                `costConv` Double NULL COMMENT 'コンバージョントラッキングクリック数に起因する費用をコンバージョン数で割った値',
                `costConvCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで、
                過去の「CostPerConversion」データがどのように表示されるかを示します。',
                `destinationURL` TEXT NULL COMMENT '広告のリンク先URL。',
                `appFinalURL` TEXT NULL COMMENT '広告の最終的なアプリURLのリスト。 リストのエントリは、
                a）「android-app：」（Androidアプリの場合）またはb）「os-app：」（iOSアプリの場合）
                のいずれかで始まります。 リスト要素はJSONリスト形式で返されます。',
                `mobileFinalURL` TEXT NULL COMMENT '広告の最終的なモバイルURLのリスト。 リスト要素はJSONリスト形式で返されます。',
                `finalURL` TEXT NULL COMMENT '広告の最終的なURLのリスト。 リスト要素はJSONリスト形式で返されます。',
                `trackingTemplate` TEXT NULL COMMENT '広告のトラッキングテンプレート。',
                `customParameter` TEXT NULL COMMENT '広告のカスタムパラメータのリスト。 CustomParameters要素はJSONマップ形式で返されます。',
                `keywordID` INT(20) NULL COMMENT '基準ID。',
                `criteriaType` VARCHAR(50) NULL COMMENT '基準のタイプ。',
                `crossDeviceConv` Double NULL COMMENT '顧客が1つの端末でAdWords広告をクリックしてか
                ら別の端末やブラウザで変換した後のコンバージョンデバイス間のコンバージョンは既に
                AllConversions列に含まれています。',
                `conversionsCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルでの過去の「コンバージョン」データの表示方法を示します。',
                `convValueCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで、
                過去の「ConversionValue」データがどのように表示されるかを示します。',
                `clientName` TEXT NULL COMMENT 'カスタマーのわかりやすい名前。',
                `day` Date NULL COMMENT '日付はyyyy-MM-ddの形式になります。',
                `dayOfWeek` VARCHAR(50) NULL COMMENT '曜日の名前です（例：「月曜日」）。',
                `description` TEXT NULL COMMENT '拡張テキスト広告または敏感なディスプレイ広告の説明文。',
                `descriptionLine1` TEXT NULL COMMENT '広告の1行目の説明。',
                `descriptionLine2` TEXT NULL COMMENT '広告の2行目の説明。',
                `device` VARCHAR(50) NULL COMMENT 'インプレッションが表示されたデバイスの種類。',
                `devicePreference` INT(20) NULL COMMENT 'デバイスプリファレンスのプラットフォームID。 
                Platformsリファレンスで、対応する名前やその他の情報を参照できます。 
                URL：https://developers.google.com/adwords/api/docs/appendix/platforms',
                `displayURL` TEXT NULL COMMENT '広告のURLを表示します。',
                `landscapeLogoIDResponsive` INT(20) NULL COMMENT 'ランドスケープロゴ画像のID。',
                `logoIDResponsive` INT(20) NULL COMMENT 'ResponsiveDisplayAdで使用されるロゴイメージのID。',
                `imageIDResponsive` INT(20) NULL COMMENT 'ResponsiveDisplayAdで使用されるマーケティングイメージのID。',
                `squareImageIDResponsive` INT(20) NULL COMMENT '正方形のマーケティングイメージのID。',
                `conversionSource` VARCHAR(50) NULL COMMENT 'ウェブサイトなどの変換元、通話からのインポート。',
                `customerID` INT(20) NULL COMMENT '顧客ID。',
                `adFormatPreferenceResponsive` VARCHAR(50) NULL COMMENT 'レスポンシブディスプレイ広告のフォーマット設定。',
                `ad` TEXT NULL COMMENT 'TextAdの広告見出し。 TemplateAdなどの他の広告タイプの場合、このフィールドには広告のキー属性の文字列表現が含まれます。',
                `headline1` TEXT NULL COMMENT '拡張テキスト広告の見出しの最初の部分。',
                `headline2` TEXT NULL COMMENT '拡張テキスト広告の見出しの2番目の部分です。',
                `adID` INT(20) NULL COMMENT 'この行の主オブジェクトのID。',
                `imageAdURL` TEXT NULL COMMENT '完全なURLを取得するには、この値の前に「
                https://tpc.googlesyndication.com/pageadimg/imgad?id=」と入力します。',
                `imageHeight` INT NULL COMMENT '画像広告の高さ。他の広告タイプの場合は、値はありません。',
                `imageWidth` INT NULL COMMENT 'イメージ広告の幅他の広告タイプの場合は、値はありません。',
                `imageMimeType` INT NULL COMMENT '画像のMIMEタイプ。イメージ広告にのみ掲載されます。',
                `imageAdName` TEXT NULL COMMENT 'イメージ広告の名前。',
                `isNegative` Boolean NULL COMMENT 'この行の基準が否定（除外）基準であるかどうかを示します。',
                `labelIDs` TEXT NULL COMMENT 'この行の主オブジェクトのラベルIDのリスト。 リスト要素はJSONリスト形式で返されます。',
                `labels` TEXT NULL COMMENT 'この行のメインオブジェクトのラベル名のリスト。 リスト要素はJSONリスト形式で返されます。',
                `longHeadline` TEXT NULL COMMENT 'レスポンシブディスプレイ広告の見出しの長い形式。',
                `mainColorResponsive` VARCHAR(50) NULL COMMENT 'レスポンシブディスプレイ広告のメインカラーです。',
                `month` Date NULL COMMENT '月の最初の日。yyyy-MM-ddの形式です。',
                `monthOfYear` VARCHAR(50) NULL COMMENT '月の名前です（例：「12月」）。',
                `path1` TEXT NULL COMMENT '展開されたテキスト広告のURLが表示された広告に表示されるテキスト。',
                `path2` TEXT NULL COMMENT '「Path1」に加えて、拡張テキスト広告のURLが表示された広告に表示されるテキスト。',
                `policy` VARCHAR(50) NULL COMMENT '広告のポリシー情報。',
                `pricePrefixResponsive` VARCHAR(50) NULL COMMENT 'プレフィックスは価格の前に表示されます。',
                `promotionTextResponsive` TEXT NULL COMMENT '反応性ディスプレイ広告のプロモーションテキスト。',
                `quarter` Date NULL COMMENT '四半期の最初の日は、yyyy-MM-ddの形式です。 四半期の暦年を使用します。たとえば、2014年第2四半期は2014-04-01に開始します。',
                `shortHeadline` TEXT NULL COMMENT 'レスポンシブディスプレイ広告の見出しの短い形式。',
                `adState` VARCHAR(50) NULL COMMENT 'この行のメインオブジェクトのステータス。たとえば、キャンペー
                ンの掲載結果レポートでは、これが各行のキャンペーンのステータスになります。広告グループの掲載結果レポー
                トでは、これは各行の広告グループのステータスになります。',
                `valueAllConv` Double NULL COMMENT 'すべてのコンバージョンの平均値です。',
                `valueConv` Double NULL COMMENT 'コンバージョン数の合計をコンバージョン数で割った値。',
                `valueConvCurrentModel` Double NULL COMMENT '現在選択しているアトリビューションモデルで、
                過去の「ValuePerConversion」データがどのように表示されるかを示します。',
                `week` Date NULL COMMENT 'yyyy-MM-ddの形式の月曜日の日付。',
                `year` INT NULL COMMENT '年はyyyyの形式です。',
                PRIMARY KEY (`id`),
                UNIQUE INDEX `id_UNIQUE` (`id` ASC),
                INDEX `repo_adw_ad_report_conv1` (`exeDate` ASC),
                INDEX `repo_adw_ad_report_conv2` (`startDate` ASC),
                INDEX `repo_adw_ad_report_conv3` (`endDate` ASC),
                INDEX `repo_adw_ad_report_conv4` (`account_id` ASC),
                INDEX `repo_adw_ad_report_conv5` (`campaign_id` ASC),
                INDEX `repo_adw_ad_report_conv6` (`accentColorResponsive` ASC),
                INDEX `repo_adw_ad_report_conv7` (`currency` ASC),
                INDEX `repo_adw_ad_report_conv8` (`timeZone` ASC),
                INDEX `repo_adw_ad_report_conv9` (`adGroupID` ASC),
                INDEX `repo_adw_ad_report_conv10` (`adGroupState` ASC),
                INDEX `repo_adw_ad_report_conv11` (`network` ASC),
                INDEX `repo_adw_ad_report_conv12` (`networkWithSearchPartners` ASC),
                INDEX `repo_adw_ad_report_conv13` (`adType` ASC),
                INDEX `repo_adw_ad_report_conv14` (`allowFlexibleColorResponsive` ASC),
                INDEX `repo_adw_ad_report_conv15` (`baseAdGroupID` ASC),
                INDEX `repo_adw_ad_report_conv16` (`baseCampaignID` ASC),
                INDEX `repo_adw_ad_report_conv17` (`callOnlyAdPhoneNumber` ASC),
                INDEX `repo_adw_ad_report_conv18` (`callToActionTextResponsive` ASC),
                INDEX `repo_adw_ad_report_conv19` (`campaignID` ASC),
                INDEX `repo_adw_ad_report_conv20` (`campaignState` ASC),
                INDEX `repo_adw_ad_report_conv21` (`clickType` ASC),
                INDEX `repo_adw_ad_report_conv22` (`approvalStatus` ASC),
                INDEX `repo_adw_ad_report_conv23` (`conversionCategory` ASC),
                INDEX `repo_adw_ad_report_conv24` (`conversionTrackerId` ASC),
                INDEX `repo_adw_ad_report_conv25` (`conversionName` ASC),
                INDEX `repo_adw_ad_report_conv26` (`keywordID` ASC),
                INDEX `repo_adw_ad_report_conv27` (`criteriaType` ASC),
                INDEX `repo_adw_ad_report_conv28` (`day` ASC),
                INDEX `repo_adw_ad_report_conv29` (`dayOfWeek` ASC),
                INDEX `repo_adw_ad_report_conv30` (`device` ASC),
                INDEX `repo_adw_ad_report_conv31` (`devicePreference` ASC),
                INDEX `repo_adw_ad_report_conv32` (`landscapeLogoIDResponsive` ASC),
                INDEX `repo_adw_ad_report_conv33` (`logoIDResponsive` ASC),
                INDEX `repo_adw_ad_report_conv34` (`imageIDResponsive` ASC),
                INDEX `repo_adw_ad_report_conv35` (`squareImageIDResponsive` ASC),
                INDEX `repo_adw_ad_report_conv36` (`conversionSource` ASC),
                INDEX `repo_adw_ad_report_conv37` (`customerID` ASC),
                INDEX `repo_adw_ad_report_conv38` (`adFormatPreferenceResponsive` ASC),
                INDEX `repo_adw_ad_report_conv39` (`adID` ASC),
                INDEX `repo_adw_ad_report_conv40` (`imageHeight` ASC),
                INDEX `repo_adw_ad_report_conv41` (`imageWidth` ASC),
                INDEX `repo_adw_ad_report_conv42` (`imageMimeType` ASC),
                INDEX `repo_adw_ad_report_conv43` (`isNegative` ASC),
                INDEX `repo_adw_ad_report_conv44` (`mainColorResponsive` ASC),
                INDEX `repo_adw_ad_report_conv45` (`month` ASC),
                INDEX `repo_adw_ad_report_conv46` (`monthOfYear` ASC),
                INDEX `repo_adw_ad_report_conv47` (`policy` ASC),
                INDEX `repo_adw_ad_report_conv48` (`pricePrefixResponsive` ASC),
                INDEX `repo_adw_ad_report_conv49` (`quarter` ASC),
                INDEX `repo_adw_ad_report_conv50` (`adState` ASC),
                INDEX `repo_adw_ad_report_conv51` (`week` ASC),
                INDEX `repo_adw_ad_report_conv52` (`year` ASC)
            )"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repo_adw_ad_report_conv');
    }
}
