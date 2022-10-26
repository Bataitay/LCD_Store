<?php
namespace App\Services\Role;

use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\Role\RoleServiceInterface;
use App\Services\BaseService;

class RoleService extends BaseService implements RoleServiceInterface{
    public $repository;

    function __construct(RoleRepositoryInterface $RoleRepositoryInterface)
    {
        $this->repository = $RoleRepositoryInterface;
    }
    function getAllWithPaginateLatest($request){
        return $this->repository->getAllWithPaginateLatest($request);
    }
    function getTrashed(){
        return $this->repository->getTrashed();
    }
    public function restore($id){
        return $this->repository->restore($id);
    }
    function force_destroy($id){
        return $this->repository->force_destroy($id);
    }
}