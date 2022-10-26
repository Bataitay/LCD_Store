<?php
namespace App\Repositories\Role;

use App\Repositories\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface{
    function getAllWithPaginateLatest($request);
    function getTrashed();
    public function restore($id);
    function force_destroy($id);
}