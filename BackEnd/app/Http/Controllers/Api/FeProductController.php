<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\Product\FeProductServiceInterface;
use Illuminate\Http\Request;

class FeProductController extends Controller
{
    private $FeproductService;
    public function __construct(FeProductServiceInterface $FeproductService){
        $this->FeproductService = $FeproductService;
    }
    public function product_list(){
       $products = $this->FeproductService->getAll();

        return response()->json($products, 200);
    }
    public function product_detail($id){
        $product = $this->FeproductService->find($id);
        return response()->json($product, 200);
    }
}
