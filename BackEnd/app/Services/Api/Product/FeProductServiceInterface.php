<?php
namespace App\Services\Api\Product;


interface FeProductServiceInterface
{
    public function getAll($request);
    public function find($id);
    public function trendingProduct();
    public function coutReviewStar($id);
}
