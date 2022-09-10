<?php
namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface{
    function getModel(){
        return Permission::class;
    }
    public function getParentPermissions(){
        return Permission::where('group_key', '=', 0)->get();
    }
    public function getChildPermissions(){
        return Permission::where('group_key', '!=', 0)->get();
    }
}