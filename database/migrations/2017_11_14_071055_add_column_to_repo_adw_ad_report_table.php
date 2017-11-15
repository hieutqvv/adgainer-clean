<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// @codingStandardsIgnoreLine
class AddColumnToRepoAdwAdReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'repo_adw_ad_report_cost',
            function (Blueprint $table) {
                $table->bigInteger('accountid')->nullable()->comment('アカウントID');
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
        Schema::table(
            'repo_adw_ad_report_cost',
            function (Blueprint $table) {
                $table->dropColumn('accountid');
            }
        );
    }
}
