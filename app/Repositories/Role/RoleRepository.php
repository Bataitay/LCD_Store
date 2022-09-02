<?php
namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface{
    function getModel(){
        return Role::class;
    }
    function create($data){
        $role = Role::create([
            'name' => $data->name,
        ]);
        $role->permissions()->attach($data->permissions_id);
    }
}