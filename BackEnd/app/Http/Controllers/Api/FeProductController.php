<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Services\Api\Product\FeProductServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeProductController extends Controller
{
    private $FeproductService;
    public function __construct(FeProductServiceInterface $FeproductService)
    {
        $this->FeproductService = $FeproductService;
    }
    public function product_list()
    {
        $products = $this->FeproductService->getAll();

        return response()->json($products, 200);
    }
    public function search(Request $request)
    {
            $products = $this->FeproductService->search($request);
            return response()->json($products, 200);
    }

    public function product_detail($id)
    {
        $product = $this->FeproductService->find($id);
        return response()->json($product, 200);
    }
    public function category_list()
    {
        $categories = Category::with('products')->take(10)->get();
        return response()->json($categories, 200);
    }
    public function trendingProduct()
    {
        $products = $this->FeproductService->trendingProduct();
        return response()->json($products, 200);
    }
    public function getBaner()
    {
        $banner = Banner::where('status', 1)->first();
        return response()->json($banner, 200);
    }
    public function getCustomer()
    {
        $customer = Customer::get();
        return response()->json($customer, 200);
    }
    public function coutReviewStar($id)
    {
        $review = $this->FeproductService->coutReviewStar($id);
        return response()->json($review, 200);
    }
}
