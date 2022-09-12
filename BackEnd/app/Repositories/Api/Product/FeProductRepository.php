<?php

namespace App\Repositories\Api\Product;

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
       $products = $this->model->all();
       return $products;
    }
    public function find($id){
        $product = $this->model->find($id);
        return $product;
    }


}
