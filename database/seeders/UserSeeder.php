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
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'address' => '133 Lý thường Kiệt',
            'gender' => 1,
            'avatar' => '',
            'phone' => '0368563954',
            'password' => bcrypt('123456789'),
        ]);
        $admin->roles()->attach(1);
    }
}
