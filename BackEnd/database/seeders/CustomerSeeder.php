<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
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
        $customer1 = Customer::create([
            'name' => 'Nguyen ngoc duong',
            'email' => 'duong@gmail.com',
            'address' => '38 Lý thường Kiệt',
            'phone' => '0987654321',
            'password' => bcrypt('123456789'),
        ]);
        $customer2 = Customer::create([
            'name' => 'Le kim chon',
            'email' => 'chon@gmail.com',
            'address' => '38 Lý thường Kiệt',
            'phone' => '0987654321',
            'password' => bcrypt('123456789'),
        ]);
        $customer3 = Customer::create([
            'name' => 'nguyen sa luy',
            'email' => 'luy@gmail.com',
            'address' => '38 Lý thường Kiệt',
            'phone' => '0987654321',
            'password' => bcrypt('123456789'),
        ]);
        $customer4 = Customer::create([
            'name' => 'nguyen thanh hai',
            'email' => 'hai@gmail.com',
            'address' => '38 Lý thường Kiệt',
            'phone' => '0987654321',
            'password' => bcrypt('123456789'),
        ]);
        $customer5 = Customer::create([
            'name' => 'nguyen duc tan',
            'email' => 'tan@gmail.com',
            'address' => '38 Lý thường Kiệt',
            'phone' => '0987654321',
            'password' => bcrypt('123456789'),
        ]);
    }
}
