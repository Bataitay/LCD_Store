<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller {
    function getAllCart(){
        $carts = Cache::get('carts');
        if($carts){
            $carts = array_values($carts);
        }else{
            $carts = [];
        }
        return response()->json($carts);
    }
    function addToCart($id){
        $product = Product::find($id);
        $carts = Cache::get('carts');
        if(isset($carts[$id])){
            $carts[$id]['quantity']++;
            $carts[$id]['price'] = $product->sale_price ?? $product->price;
        }else{
            $carts[$id] = [
                'id' => $id,
                'quantity' => 1,
                'name' => $product->name,
                'price' => $product->sale_price ?? $product->price,
                'image' => $product->image,
            ];
        }
        Cache::put('carts', $carts);
    }
    function removeToCart($id){
        $carts = Cache::get('carts');
        unset($carts[$id]);
        Cache::put('carts', $carts);
    }
    function removeAllCart(){
        Cache::forget('carts');
    }
    function updateCart($id, $quantity){
        $carts = Cache::get('carts');
        $carts[$id]['quantity'] = $quantity;
        Cache::put('carts', $carts);
    }
}
