<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Seeder;

// @codingStandardsIgnoreLine
class CampaignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $command = 'mysql -h'
            . Config::get('database.connections.mysql.host')
            . ' -u'
            . Config::get('database.connections.mysql.username')
            . ' -p'
            . Config::get('database.connections.mysql.password')
            . ' '
            . Config::get('database.connections.mysql.database')
            . ' < '
            .  __DIR__ . '/../../database/resources/campaigns.sql';

        exec($command);
    }
}
