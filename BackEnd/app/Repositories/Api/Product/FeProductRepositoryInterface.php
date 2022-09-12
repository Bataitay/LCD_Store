<?php
namespace App\Repositories\Api\Product;

use App\Repositories\Api\RepositoryInterface;

interface FeProductRepositoryInterface extends RepositoryInterface{
    public function getAll();
    public function find($id);
}
