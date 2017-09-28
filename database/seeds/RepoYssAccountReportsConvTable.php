<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// @codingStandardsIgnoreLine
class RepoYssAccountReportsConvTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(
            file_get_contents(__DIR__ . '/../../database/resources/repo_yss_account_report_convs.sql')
        );
    }
}
