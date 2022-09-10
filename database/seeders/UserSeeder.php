<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'address' => '38 Lý thường Kiệt',
            'gender' => 1,
            'province_id' => '30',
            'district_id' => '335',
            'ward_id' => '6090',
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $writer = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'address' => '38 Lý thường Kiệt',
            'gender' => 0,
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $manager = User::create([
            'name' => 'Manage',
            'email' => 'manage@admin.com',
            'address' => '38 Lý thường Kiệt',
            'gender' => 1,
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $writer = User::create([
            'name' => 'Writer',
            'email' => 'writer@admin.com',
            'address' => '38 Lý thường Kiệt',
            'gender' => 0,
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $admin->roles()->attach(1);
    }
}
