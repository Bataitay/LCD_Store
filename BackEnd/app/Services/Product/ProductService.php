<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\BaseService;

class ProductService extends BaseService implements ProductServiceInterface {

    public $repository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }
    public function all($request)
    {
        return $this->repository->all($request);
    }
    public function update($id, $data){
        return $this->repository->update($id, $data);
    }
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
    public function getTrashed()
    {
        return $this->repository->getTrashed();
    }
    public function restore($id){
        return $this->repository->restore($id);
    }
    public function force_destroy($id){
        return $this->repository->force_destroy($id);
    }

}
