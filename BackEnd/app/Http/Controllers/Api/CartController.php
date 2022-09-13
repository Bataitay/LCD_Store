<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller {
    function addToCart($id){
        $product = Product::find($id);
        $carts = Cache::get('carts');
        if(isset($carts[$id])){
            $carts[$id]['quantity']++;
            $carts[$id]['price'] = $product->sale_price ?? $product->price;
        }else{
            $carts[$id] = [
                'quantity' => 1,
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
            ];
        }
        Cache::put('carts', $carts);
        echo "<pre>";
        print_r($carts);
    }
    function removeToCart($id){
        $carts = Cache::get('carts');
        unset($carts[$id]);
        Cache::put('carts', $carts);
        echo "<pre>";
        print_r($carts);
    }
}
