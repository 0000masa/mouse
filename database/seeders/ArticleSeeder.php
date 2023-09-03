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
                'product' => 'gpro wireless',
                'price' => 10000,
                'weight'=> 80,
                'maximum_dpi'=>25400,
                'buttons'=>5,
                'explanation'=>'元祖最強のマウスです。。',
                'manufacture_id'=>1,
                'user_id'=> 2,
                'connection_id'=>1,
                'battery_id'=>1,
                'evaluation_id'=>1,
                'image_url'=>null,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
    }
} 
