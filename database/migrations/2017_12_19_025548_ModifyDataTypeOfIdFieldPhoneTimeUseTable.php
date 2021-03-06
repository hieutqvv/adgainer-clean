<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// @codingStandardsIgnoreLine
class ModifyDataTypeOfIdFieldPhoneTimeUseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!App::environment('production')) {
            Schema::table(
                'phone_time_use',
                function (Blueprint $table) {
                    $table->integer('id', true)->change();
                }
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!App::environment('production')) {
            Schema::table(
                'phone_time_use',
                function (Blueprint $table) {
                    $table->increments('id')->change();
                }
            );
        }
    }
}
