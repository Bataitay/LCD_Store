<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('assets/sql/dcjsnezphosting_crm.sql');
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }
}
