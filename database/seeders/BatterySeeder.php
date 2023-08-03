<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class BatterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('batteries')->insert([
                'battery' => '有線',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
}
