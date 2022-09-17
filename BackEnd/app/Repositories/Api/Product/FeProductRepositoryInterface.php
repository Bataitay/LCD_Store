<?php
namespace App\Repositories\Api\Product;

use App\Repositories\Api\RepositoryInterface;

interface FeProductRepositoryInterface extends RepositoryInterface{
    public function getAll($request);
    public function find($id);
    public function trendingProduct();
    public function coutReviewStar($id);

}
