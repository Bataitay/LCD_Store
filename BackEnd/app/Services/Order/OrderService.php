<?php
namespace App\Services\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\Order\OrderServiceInterface;
use App\Services\BaseService;

class OrderService extends BaseService implements OrderServiceInterface{
    public $repository;

    function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->repository = $orderRepositoryInterface;
    }
    function getAllWithPaginateLatest($request){
        return $this->repository->getAllWithPaginateLatest($request);
    }
    function updateSingle($id){
        return $this->repository->updateSingle($id);
    }
}
