<?php

namespace App\Repositories\Api\Product;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Api\BaseRepository;
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
    public function find($id){
        $product = $this->model->with('specification')->with('file_names')->find($id);
        return $product;
    }



}
