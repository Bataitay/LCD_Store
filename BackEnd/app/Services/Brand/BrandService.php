<?php

namespace App\Services\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Services\BaseService;

class BrandService extends BaseService implements BrandServiceInterface {

    public $repository;
    public function __construct(BrandRepositoryInterface $brandRepository)
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


