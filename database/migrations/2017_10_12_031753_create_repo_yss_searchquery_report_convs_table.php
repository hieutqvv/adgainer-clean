<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// @codingStandardsIgnoreLine
class CreateRepoYssSearchqueryReportConvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'repo_yss_searchquery_report_conv',
            function (Blueprint $table) {
                $table->increments('id');
                $table->date('exeDate')->comment('YSSレポートAPI実行日');
                $table->date('startDate')->comment('YSSレポートAPIで指定したレポートの開始日');
                $table->date('endDate')->comment('YSSレポートAPIで指定したレポートの終了日');
                $table->string('account_id', 50)->nullable()->comment('ADgainerシステムのアカウントID');
                $table->string('campaign_id', 50)
                    ->nullable()
                    ->comment('ADgainerシステムのキャンペーンID\ndestinationURLのクエリパラメータを分解して取得');
                $table->bigInteger('campaignID')->nullable()->comment('キャンペーンID');
                $table->bigInteger('adgroupID')->nullable()->comment('広告グループID');
                $table->bigInteger('keywordID')->nullable()->comment('キーワードID');
                $table->text('campaignName')->nullable()->comment('キャンペーン名');
                $table->text('adgroupName')->nullable()->comment('広告グループ名');
                $table->text('searchQueryDestinationURL')->nullable()->comment('クリックされたURL');
                $table->text('searchQuery')->nullable()->comment('検索クエリー');
                $table->string('searchQueryMatchType', 50)->nullable()->comment('検索クエリーのマッチタイプ');
                $table->text('keyword')->nullable()->comment('キーワード');
                $table->text('trackingURL')->nullable()->comment('トラッキングURL');
                $table->text('landingPageURL')->nullable()->comment('最終リンク先URL');
                $table->double('conversions')->nullable()->comment('コンバージョン数');
                $table->double('convValue')->nullable()->comment('コンバージョンの価値');
                $table->double('valuePerConv')->nullable()->comment('価値/コンバージョン数');
                $table->double('allConv')->nullable()->comment('すべてのコンバージョン数');
                $table->double('allConvValue')->nullable()->comment('すべてのコンバージョンの価値');
                $table->double('valuePerAllConv')->nullable()->comment('価値/すべてのコンバージョン数');
                $table->bigInteger('campaignTrackingID')->nullable()->comment('キャンペーントラッキングID');
                $table->bigInteger('adgroupTrackingID')->nullable()->comment('広告グループトラッキングID');
                $table->bigInteger('keywordTrackingID')->nullable()->comment('キーワードトラッキングID');
                $table->string('network', 50)->nullable()->comment('広告掲載方式の指定');
                $table->string('device', 50)->nullable()->comment('デバイス');
                $table->dateTime('day')->nullable()
                    ->comment('レコードの対象日：年（year）、月（monthofYear）、日（day）。左項目を加工してDATETIMEに変換');
                $table->string('dayOfWeek', 50)->nullable()->comment('曜日');
                $table->string('quarter', 50)->nullable()->comment('四半期');
                $table->string('month', 50)->nullable()->comment('毎月');
                $table->string('week', 50)->nullable()->comment('毎週');
                $table->string('objectiveOfConversionTracking', 50)->nullable()->comment('コンバージョン測定の目的');
                $table->text('conversionName')->nullable()->comment('コンバージョン名');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repo_yss_searchquery_report_conv');
    }
}
