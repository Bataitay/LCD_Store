<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Specifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Category_Brand_Product_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $macbook = Category::create([
            'id' => 1,
            'name' => 'MacBook Air',
        ]);
        $macbook = Category::create([
            'id' => 2,
            'name' => 'MacBook Pro',
        ]);
        $asus = Category::create([
            'id' => 3,
            'name' => 'TUF Gaming',
        ]);
        $asus = Category::create([
            'id' => 4,
            'name' => 'ZenBook',
        ]);
        $dell = Category::create([
            'id' => 5,
            'name' => 'XPS',
        ]);
        $dell = Category::create([

            'id' => 6,
            'name' => 'Alienware',
        ]);
        $acer = Category::create([
            'id' => 7,
            'name' => 'Aspire',
        ]);
        $acer = Category::create([
            'id' => 8,
            'name' => 'Nitro',
        ]);
        //brands
        $macbook = Brand::create([
            'id' => 1,
            'name' => 'MacBook ',
            'logo' => 'MacBook ',
        ]);
        $asus = Brand::create([
            'id' => 2,
            'name' => 'Asus',
            'logo' => 'MacBook ',
        ]);
        $dell = Brand::create([
            'id' => 3,
            'name' => 'Dell',
            'logo' => 'MacBook ',
        ]);
        $acer = Brand::create([
            'id' => 4,
            'name' => 'Acer',
            'logo' => 'MacBook ',
        ]);

        //products
        $macbook = Product::create([
            'id' => 1,
            'name' => 'MacBook Air M1 2020',
            'price' => '33990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '1',
            'category_id' => '1',
            'status' => '1',
            'created_by' => '1',
            'image' => '1',

        ]);
        $macbook = Product::create([
            'id' => 2,
            'name' => 'MacBook Pro M2 2022',
            'price' => '35990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '1',
            'category_id' => '2',
            'status' => '0',
            'created_by' => '2',
            'image' => '1',

        ]);
        $macbook = Product::create([
            'id' => 3,
            'name' => 'Asus TUF Gaming FX506LHB ',
            'price' => '23990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '2',
            'category_id' => '3',
            'status' => '0',
            'created_by' => '1',
            'image' => '1',

        ]);
        $macbook = Product::create([
            'id' => 4,
            'name' => 'Asus ZenBook UX425EA',
            'price' => '33990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '2',
            'category_id' => '4',
            'status' => '1',
            'created_by' => '2',
            'image' => '1',

        ]);
        $macbook = Product::create([
            'id' => 5,
            'name' => 'Acer TravelMate B3 TMB311 ',
            'price' => '33990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '3',
            'category_id' => '5',
            'status' => '1',
            'created_by' => '3',
            'image' => '1',

        ]);
        $macbook = Product::create([
            'id' => 6,
            'name' => 'Acer Nitro 5 Gaming AN515 ',
            'price' => '21990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '3',
            'category_id' => '6',
            'status' => '0',
            'created_by' => '3',
            'image' => '1',

        ]);
        $macbook = Product::create([
            'id' => 7,
            'name' => 'Dell Gaming G15 5511 ',
            'price' => '24990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '4',
            'category_id' => '7',
            'status' => '1',
            'created_by' => '4',
            'image' => '1',

        ]);
        $macbook = Product::create([
            'id' => 8,
            'name' => 'Dell Gaming Alienware m15 R6 ',
            'price' => '53990000',
            'sale_price' => '11',
            'quantity' => '100',
            'brand_id' => '4',
            'category_id' => '8',
            'status' => '1',
            'created_by' => '4',
            'image' => '1',

        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '1',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '1',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '2',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '3',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '4',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '5',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '6',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '7',
        ]);
        $specifications = Specifications::create([
            'cpu' => 'Apple M2100GB/s',
            'ram' => '8 GB',
            'rom' => '256 GB SSD',
            'display' => '13.3"Retina (2560 x 1600)',
            'battery' => 'Khoảng 10 tiếng',
            'color' => 'gray',
            'product_id' => '8',
        ]);

    }
}
