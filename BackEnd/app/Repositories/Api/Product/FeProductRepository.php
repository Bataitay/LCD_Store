<?php

namespace App\Repositories\Api\Product;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Api\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeProductRepository extends BaseRepository implements FeProductRepositoryInterface
{

    function getModel()
    {
        return Product::class;
    }
    public function getAll()
    {
        $products = $this->model->take(18)->get();
        return $products;
    }
    public function find($id)
    {
        $product = $this->model->with('specification')->with('file_names')
            ->with('brand')->with('category')->find($id);
            dd($product);
        return $product;
    }
    public function trendingProduct(){
        $trendingPro = DB::table('order_details')
        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->selectRaw('products.*, count(order_details.product_id) totalByQuan')
        ->groupBy('order_details.product_id')
        ->orderBy('totalByQuan', 'desc')
        ->take(10)
        ->get();
        return $trendingPro;
    }
}
