<?php

namespace App\Repositories\Api\Product;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Api\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeProductRepository extends BaseRepository implements FeProductRepositoryInterface
{

    function getModel()
    {
        return Product::class;
    }
    public function getAll($request)
    {
        $products = $this->model->take(18)->get();
        if (!empty($request->search)) {
            $search = $request->search;
            $products = $products->search($search);
        }
        if (!empty($request->category_id)) {
            $products->nameCate($request);
        }
        if (!empty($request->brand_id)) {
            $products->nameBrand($request);
        }
        // $products->filterPrice(request(['startPrice', 'endPrice']));
        return $products;
    }
    public function find($id)
    {
        $product = $this->model
            ->with([
                'specification', 'file_names', 'brand', 'category', 'reviews'
                => function ($query) {
                    return $query->with([
                        'answers'
                        => function ($query) {
                            return $query->with('customer');
                        }
                    ]);
                }
            ])->find($id);
        return $product;
    }
    public function trendingProduct()
    {
        $trendingPro = DB::table('order_details')
            ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
            ->selectRaw('products.*, count(order_details.product_id) totalByQuan')
            ->groupBy('order_details.product_id')
            ->orderBy('totalByQuan', 'desc')
            ->take(8)
            ->get();
        return $trendingPro;
    }
    public function coutReviewStar($id)
    {
        $product = $this->model->find($id);
        foreach ($product->reviews as $key =>  $value) {
            $review = [
                'oneStar' => count($value->where('vote', '1')->where('product_id', $product->id)->pluck('vote')->all()),
                'twoStar' => count($value->where('vote', '2')->where('product_id', $product->id)->pluck('vote')->all()),
                'threeStar' => count($value->where('vote', '3')->where('product_id', $product->id)->pluck('vote')->all()),
                'fourStar' => count($value->where('vote', '4')->where('product_id', $product->id)->pluck('vote')->all()),
                'fiveStar' => count($value->where('vote', '5')->where('product_id', $product->id)->pluck('vote')->all()),
            ];
        }
        return $review;
    }
}
