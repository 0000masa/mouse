<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('evaluations')->insert([
                'level' => '星5 とても良い',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
}
