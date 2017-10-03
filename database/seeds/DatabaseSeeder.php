<?php

use Illuminate\Database\Seeder;

// @codingStandardsIgnoreLine
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RepoYssAccountReportTable::class);
        $this->call(RepoYssAccountsTable::class);
        $this->call(RepoYssAccountReportsCostTable::class);
        $this->call(RepoYssAccountReportsConvTable::class);
        $this->call(RepoYssCampaignReportConvsTable::class);
        $this->call(RepoYssCampaignReportCostsTable::class);
    }
}
