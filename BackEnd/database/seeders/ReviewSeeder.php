<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=8;$i++){
        DB::table('reviews')->insert([
            'content' => 'màu sắc, hình ảnh đẹp',
            'vote' => 5,
            'status' => 0,
            'product_id' =>  mt_rand(1,8),
            'customer_id' =>  mt_rand(1,5),
        ]);
    }
    }
}
