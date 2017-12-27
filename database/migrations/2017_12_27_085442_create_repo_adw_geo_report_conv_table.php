<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// @codingStandardsIgnoreLine
class CreateRepoAdwGeoReportConvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE TABLE `repo_adw_geo_report_conv` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `exeDate` DATE NOT NULL COMMENT 'レポートAPI実行日',
                `startDate` DATE NOT NULL COMMENT 'APIで指定したレポートの開始日',
                `endDate` DATE NOT NULL COMMENT 'APIで指定したレポートの終了日',
                `account_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのアカウントID',
                `campaign_id` VARCHAR(50) NOT NULL COMMENT 'ADgainerシステムのキャンペーンID。
                destinationURLのクエリパラメータを分解して取得',
                `currency` VARCHAR(50) NULL COMMENT '顧客口座の通貨。',
                `account` TEXT NULL COMMENT 'カスタマーアカウントのわかりやすい名前。',
                `timeZone` VARCHAR(50) NULL COMMENT '顧客アカウント用に選択されたタイムゾーンの名前。 たとえば、
                「（GMT-05：00）東部時間」などです。 このフィールドには、タイムゾーンの夏時間の現在の状態は反映されません。',
                `adType` VARCHAR(50) NULL COMMENT '広告の基礎となるメディア形式。 値は[テンプレート広告]ページ
                （URL：https://developers.google.com/adwords/api/docs/appendix/templateads）、またはMediaType
                （URL：https://developers.google.com/adwords/api/docs/reference/latest/AdGroupAdService.Media.MediaType）
                列挙型です。',
                `adGroupID` INT(20) NULL COMMENT '広告グループのID。',
                `adGroup` TEXT NULL COMMENT '広告グループの名前。',
                `adGroupState` VARCHAR(50) NULL COMMENT '広告グループのステータス。',
                `network` VARCHAR(50) NULL COMMENT '第1レベルのネットワークタイプ。',
                `networkWithSearchPartners` VARCHAR(50) NULL COMMENT '第2レベルのネットワークタイプ（検索パートナーを含む）。',
                `allConvRate` Double NULL COMMENT 'AllConversionsをコンバージョントラッキングできる合計クリック数で割ったものです。
                これは、広告のクリックがコンバージョンにつながった頻度です。',
                `allConv` Double NULL COMMENT 'AdWordsが推進するコンバージョン数の最善の見積もり。ウェブサイト、クロスデバイス、
                電話通話のコンバージョンが含まれます。',
                `allConvValue` Double NULL COMMENT '推定されたものを含む、すべてのコンバージョンの合計値。',
                `campaignID` INT(20) NULL COMMENT 'キャンペーンのID。',
                `campaign` TEXT NULL COMMENT 'キャンペーンの名前。',
                `campaignState` VARCHAR(50) NULL COMMENT 'キャンペーンのステータス。',
                `city` INT NULL COMMENT '印象に関連付けられた都市のID。 LocationCriterionService（URL：
                https://developers.google.com/adwords/api/docs/reference/latest/LocationCriterionService）
                を使用して、対応する名前やその他の情報を検索できます。',
                `conversionCategory` VARCHAR(255) NULL COMMENT 'ユーザーがコンバージョンを達成するために実行するアクションを表すカテゴリ。
                ゼロ変換の行が返されないようにします。値：「ダウンロード」、「リード」、「購入/販売」、「サインアップ」、「キーページの表示」、「その他」の値。',
                `convRate` Double NULL COMMENT 'コンバージョン数をコンバージョンにトラッキングできる合計クリック数で割ったものです。',
                `conversions` Double NULL COMMENT '最適化を選択したすべてのコンバージョンアクションのコンバージョン数。',
                `conversionTrackerId` INT(20) NULL COMMENT 'コンバージョントラッカーのID。',
                `conversionName` VARCHAR(255) NULL COMMENT 'コンバージョンタイプの名前。ゼロ変換の行が返されないようにします。',
                `totalConvValue` Double NULL COMMENT 'すべてのコンバージョンのコンバージョン値の合計。',
                `costAllConv` Double NULL COMMENT '総費用をすべてのコンバージョンで割った値。',
                `costConv` Double NULL COMMENT 'コンバージョントラッキングクリック数に起因する費用をコンバージョン数で割った値',
                `countryTerritory` INT NULL COMMENT 'インプレッションに関連付けられた国のID。
                LocationCriterionService を使用すると、対応する名前やその他の情報を参照できます。',
                `crossDeviceConv` Double NULL COMMENT '顧客が1つの端末でAdWords広告をクリックしてから別の端末やブラウザで変換した後のコンバ
                ージョンデバイス間のコンバージョンは既にAllConversions列に含まれています。',
                `clientName` TEXT NULL COMMENT 'カスタマーのわかりやすい名前。',
                `day` Date NULL COMMENT '日付はyyyy-MM-ddの形式になります。',
                `dayOfWeek` VARCHAR(50) NULL COMMENT '曜日の名前です（例：「月曜日」）。',
                `device` VARCHAR(50) NULL COMMENT 'インプレッションが表示されたデバイスの種類。',
                `conversionSource` VARCHAR(50) NULL COMMENT 'ウェブサイトなどの変換元、通話からのインポート。',
                `customerID` INT(20) NULL COMMENT '顧客ID。',
                `isTargetable` Boolean NULL COMMENT '行の場所（インプレッションに関連付けられたすべての場所の中）
                が、その行のインプレッションのターゲティングの場所であるかどうかを示します。',
                `locationType` VARCHAR(50) NULL COMMENT '場所のタイプ。 AREA_OF_INTERESTは、検索された場所、
                または表示されたコンテンツから派生した場所を示します。 LOCATION_OF_PRESENCEは、ユーザーの実際の物理的な場所です。',
                `metroArea` INT NULL COMMENT 'メトロエリアのID印象に関連付けられた場所。 LocationCriterionService
                （URL：https://developers.google.com/adwords/api/docs/reference/latest/LocationCriterionService）
                を使用して、対応する名前やその他の情報を検索できます。',
                `month` Date NULL COMMENT '月の最初の日。yyyy-MM-ddの形式です。',
                `monthOfYear` VARCHAR(50) NULL COMMENT '月の名前です（例：「12月」）。',
                `mostSpecificLocation` INT(20) NULL COMMENT 'インプレッションに関連付けられた最も具体的なロケーション基準のID。
                LocationCriterionService
                （URL：https://developers.google.com/adwords/api/docs/reference/latest/LocationCriterionService）
                を使用して、対応する名前やその他の情報を検索できます。',
                `quarter` Date NULL COMMENT '四半期の最初の日は、yyyy-MM-ddの形式です。四半期の暦年を使用します。
                たとえば、2014年第2四半期は2014-04-01に開始します。',
                `region` INT NULL COMMENT 'インプレッションに関連付けられた地域のID。 LocationCriterionService
                （URL：https://developers.google.com/adwords/api/docs/reference/latest/LocationCriterionService）
                を使用して、対応する名前やその他の情報を検索できます。',
                `valueAllConv` Double NULL COMMENT 'すべてのコンバージョンの平均値です。',
                `valueConv` Double NULL COMMENT 'コンバージョン数の合計をコンバージョン数で割った値。',
                `viewThroughConv` INT(20) NULL COMMENT 'ビュースルーコンバージョンの合計数。これは、ディスプレイネットワーク広告が表示された後、
                後で他の広告とやり取り（クリックなど）せずにサイトのコンバージョンを達成した場合に発生します。
                このフィールドは、米国のロケールを使用してフォーマットされています。つまり、3桁区切り「,」、小数点区切りは「.」を使用しています。',
                `week` Date NULL COMMENT 'yyyy-MM-ddの形式の月曜日の日付。',
                `year` INT NULL COMMENT '年はyyyyの形式です。',
                PRIMARY KEY (`id`),
                UNIQUE INDEX `id_UNIQUE` (`id` ASC),
                INDEX `repo_adw_geo_report_conv1` (`exeDate` ASC),
                INDEX `repo_adw_geo_report_conv2` (`startDate` ASC),
                INDEX `repo_adw_geo_report_conv3` (`endDate` ASC),
                INDEX `repo_adw_geo_report_conv4` (`account_id` ASC),
                INDEX `repo_adw_geo_report_conv5` (`campaign_id` ASC),
                INDEX `repo_adw_geo_report_conv6` (`currency` ASC),
                INDEX `repo_adw_geo_report_conv7` (`timeZone` ASC),
                INDEX `repo_adw_geo_report_conv8` (`adType` ASC),
                INDEX `repo_adw_geo_report_conv9` (`adGroupID` ASC),
                INDEX `repo_adw_geo_report_conv10` (`adGroupState` ASC),
                INDEX `repo_adw_geo_report_conv11` (`network` ASC),
                INDEX `repo_adw_geo_report_conv12` (`networkWithSearchPartners` ASC),
                INDEX `repo_adw_geo_report_conv13` (`campaignID` ASC),
                INDEX `repo_adw_geo_report_conv14` (`campaignState` ASC),
                INDEX `repo_adw_geo_report_conv15` (`city` ASC),
                INDEX `repo_adw_geo_report_conv16` (`conversionCategory` ASC),
                INDEX `repo_adw_geo_report_conv17` (`conversionTrackerId` ASC),
                INDEX `repo_adw_geo_report_conv18` (`conversionName` ASC),
                INDEX `repo_adw_geo_report_conv19` (`countryTerritory` ASC),
                INDEX `repo_adw_geo_report_conv20` (`day` ASC),
                INDEX `repo_adw_geo_report_conv21` (`dayOfWeek` ASC),
                INDEX `repo_adw_geo_report_conv22` (`device` ASC),
                INDEX `repo_adw_geo_report_conv23` (`conversionSource` ASC),
                INDEX `repo_adw_geo_report_conv24` (`customerID` ASC),
                INDEX `repo_adw_geo_report_conv25` (`isTargetable` ASC),
                INDEX `repo_adw_geo_report_conv26` (`locationType` ASC),
                INDEX `repo_adw_geo_report_conv27` (`metroArea` ASC),
                INDEX `repo_adw_geo_report_conv28` (`month` ASC),
                INDEX `repo_adw_geo_report_conv29` (`monthOfYear` ASC),
                INDEX `repo_adw_geo_report_conv30` (`mostSpecificLocation` ASC),
                INDEX `repo_adw_geo_report_conv31` (`quarter` ASC),
                INDEX `repo_adw_geo_report_conv32` (`region` ASC),
                INDEX `repo_adw_geo_report_conv33` (`week` ASC),
                INDEX `repo_adw_geo_report_conv34` (`year` ASC)
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
        Schema::dropIfExists('repo_adw_geo_report_conv');
    }
}
