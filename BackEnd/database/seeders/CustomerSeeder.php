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
        $order1 = Order::create([
            'id' => 1,
            'status' => 0,
            'address' =>'38 Lý thường Kiệt',
            'order_total_price' => '12332',
            'customer_id' => 1
        ]);
        $order2 = Order::create([
            'id' => 2,
            'status' => 0,
            'address' =>'38 Lý thường Kiệt',
            'order_total_price' => '245',
            'customer_id' => 2
        ]);
        $order3 = Order::create([
            'id' => 3,
            'status' => 0,
            'address' =>'38 Lý thường Kiệt',
            'order_total_price' => '1256',
            'customer_id' => 3
        ]);
        $order3 = Order::create([
            'id' => 4,
            'status' => 0,
            'address' =>'38 Lý thường Kiệt',
            'order_total_price' => '865',
            'customer_id' => 4
        ]);

        $orderDetails1 = OrderDetail::create([
            'product_price' => '132',
            'product_quantity' =>'1232',
            'product_id' => 1,
            'order_id' => 1
        ]);
        $orderDetails2 = OrderDetail::create([
            'product_price' => '1132',
            'product_quantity' =>'32',
            'product_id' => 2,
            'order_id' => 2
        ]);
        $orderDetails3 = OrderDetail::create([
            'id' => 3,
            'product_price' => '1132',
            'product_quantity' =>'32',
            'product_id' => 1,
            'order_id' => 1
        ]);
        $orderDetails4 = OrderDetail::create([
            'id' => 4,
            'product_price' => '4532',
            'product_quantity' =>'12',
            'product_id' => 2,
            'order_id' => 2
        ]);
        $orderDetails5 = OrderDetail::create([
            'id' => 5,
            'product_price' => '832',
            'product_quantity' =>'122',
            'product_id' => 4,
            'order_id' => 3
        ]);
        $orderDetails6 = OrderDetail::create([
            'id' => 6,
            'product_price' => '1532',
            'product_quantity' =>'232',
            'product_id' => 6,
            'order_id' => 2
        ]);
        $orderDetails7 = OrderDetail::create([
            'id' => 7,
            'product_price' => '4132',
            'product_quantity' =>'123',
            'product_id' => 4,
            'order_id' => 4
        ]);
        $orderDetails8 = OrderDetail::create([
            'id' => 8,
            'product_price' => '1232',
            'product_quantity' =>'92',
            'product_id' => 3,
            'order_id' => 3
        ]);
    }
}
