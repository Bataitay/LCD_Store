<?php
namespace App\Services\Api\Product;


interface FeProductServiceInterface
{
    public function getAll();
    public function find($id);
    public function trendingProduct();
}
