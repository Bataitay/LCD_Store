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
            'email' => 'superadmin@admin.com',
            'name' => 'Nguyễn Ngọc Dương',
            'address' => '38 Lý thường Kiệt',
            'gender' => 0,
            'province_id' => '30',
            'district_id' => '335',
            'ward_id' => '6090',
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $writer = User::create([
            'email' => 'ngochuyen@admin.com',
            'name' => 'Nguyễn Hoàng Ngọc Huyền ',
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
            'email' => 'ngochang@admin.com',
            'name' => 'Nguyễn Hoàng Ngọc Huyền ',
            'address' => '38 Lý thường Kiệt',
            'gender' => 1,
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $employee = User::create([
            'email' => 'thaotrang@admin.com',
            'name' => 'Phan nguyễn Thảo Trang ',
            'address' => '38 Lý thường Kiệt',
            'gender' => 1,
            'province_id' => '1',
            'district_id' => '2',
            'ward_id' => '17',
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $admin_role = Role::create([
            'name' => 'Super Admin',
        ]);
        $writer_role = Role::create([
            'name' => 'writer',
        ]);
        $manager_role = Role::create([
            'name' => 'manager',
        ]);
        $Employee_role = Role::create([
            'name' => 'employee',
        ]);
    }
}
