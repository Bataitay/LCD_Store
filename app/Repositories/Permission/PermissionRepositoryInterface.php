<?php
namespace App\Repositories\Permission;

use App\Repositories\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface{
    public function getParentPermissions();
    public function getChildPermissions();
}