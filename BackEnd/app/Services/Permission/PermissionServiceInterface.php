<?php
namespace App\Services\Permission;

use App\Services\ServiceInterface;

interface PermissionServiceInterface extends ServiceInterface{
    public function getParentPermissions();
    public function getChildPermissions();
}