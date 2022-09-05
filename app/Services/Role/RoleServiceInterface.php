<?php
namespace App\Services\Role;

use App\Services\ServiceInterface;

interface RoleServiceInterface extends ServiceInterface{
    function getAllWithPaginateLatest($request);
}