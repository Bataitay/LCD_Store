<?php

namespace App\Services\Api\Product;

use App\Services\Api\BaseService;
use App\Repositories\Api\Product\FeProductRepositoryInterface;

class FeProductService extends BaseService implements FeProductServiceInterface {

    public $repository;
    public function __construct(FeProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }


}
