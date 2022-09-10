<?php
namespace App\Services\Permission;

use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\BaseService;

class PermissionService extends BaseService implements PermissionServiceInterface{
    public $repository;

    function __construct(PermissionRepositoryInterface $PermissionRepositoryInterface)
    {
        $this->repository = $PermissionRepositoryInterface;
    }
    public function getParentPermissions(){
        return $this->repository->getParentPermissions();
    }
    public function getChildPermissions(){
        return $this->repository->getChildPermissions();
    }
}