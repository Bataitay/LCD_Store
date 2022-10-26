<?php
namespace App\Services\Banner;

use App\Repositories\Banner\BannerRepositoryInterface;
use App\Services\Banner\BannerServiceInterface;
use App\Services\BaseService;

class BannerService extends BaseService implements BannerServiceInterface{
    public $repository;

    function __construct(BannerRepositoryInterface $bannerRepositoryInterface)
    {
        $this->repository = $bannerRepositoryInterface;
    }
    function updateStatus($id, $status){
        $this->repository->updateStatus($id, $status);
    }
}
