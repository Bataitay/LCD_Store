<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=10;$i++){

            DB::table('customers')->insert([
                'name' => fake()->name,
                'phone' => mt_rand(111111111,999999999),
                'email' => fake()->unique()->email,
                'password' => Hash::make('12345678'),
                'address' => fake()->address(),
            ]);
        }
    }
}
