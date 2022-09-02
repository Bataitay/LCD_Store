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
}