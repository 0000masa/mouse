<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ManufactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manufactures')->insert([[
                'name' => 'SteelSeries',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ],[
                'name' => 'Corsair',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ],[
                'name' => 'ROCCAT',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ],[
                'name' => 'HyperX',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ],[
                'name' => 'ROG',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ],[
                'name' => 'エレコム',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ],[
                'name' => 'ZOWIE',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ],[
                'name' => 'その他',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]]);
    }
}
