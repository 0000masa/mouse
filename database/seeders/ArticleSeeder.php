<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('articles')->insert([
                'product' => 'gpro x superlight',
                'price' => 16000,
                'weight'=> 63,
                'maximum_dpi'=>25400,
                'buttons'=>5,
                'explanation'=>'最強のマウスです。迷ったら買うべき。',
                'manufacture_id'=>1,
                'user_id'=> 1,
                'connection_id'=>1,
                'battery_id'=>1,
                'evaluation_id'=>1,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
} 
