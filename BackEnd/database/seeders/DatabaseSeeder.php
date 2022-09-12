<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->importBrand();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            Category_Brand_Product_Seeder::class,
            ImportSqlSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,

            CustomerSeeder::class,
            ReviewSeeder::class,

        ]);
    }
    // function importBrand(){
    //     for($i=1;$i<=5;$i++){

    //         DB::table('brands')->insert([
    //             'name' => Str::random(10).$i,
    //             'logo' => Str::random(10).$i,
    //         ]);
    //     }
    // }
}
