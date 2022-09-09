<?php

namespace App\Services\Customer;

use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Services\BaseService;

class CustomerService extends BaseService implements CustomerServiceInterface {

    public $repository;
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->repository = $customerRepository;
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
    public function searchCustomer($name)
    {
        return $this->repository->searchCustomer($name);
    }



}


