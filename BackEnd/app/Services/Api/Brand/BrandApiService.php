<?php

namespace App\Services\Api\Brand;

use App\Repositories\api\Brand\BrandApiRepositoryInterface;
use App\Services\Api\Brand\BrandApiServiceInterface;
use App\Services\BaseService;

class BrandApiService extends BaseService implements BrandApiServiceInterface {

    public $repository;
    public function __construct(BrandApiRepositoryInterface $brandRepository)
    {
        $this->repository = $brandRepository;
    }
    public function getTrash()
    {
        return $this->repository->getTrash();

    }
    public function restore($id)
    {
        return $this->repository->restore($id);
    }
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }
    public function searchBrand($name)
    {
        return $this->repository->searchBrand($name);
    }



}


