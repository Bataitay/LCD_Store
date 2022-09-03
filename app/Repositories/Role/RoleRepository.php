<?php
namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface{
    function getModel(){
        return Role::class;
    }
    function all($request){
        $roles = $this->model->latest()->paginate(1);
        if(isset($request->search)){
            $roles = $this->model->where('name', 'LIKE', '%'.request()->search.'%')->paginate(1);
        }
        return $roles;
    }
    function create($data){
        $role = Role::create([
            'name' => $data->name,
        ]);
        $role->permissions()->attach($data->permissions_id);
    }
    function update($id ,$data){
        $role = $this->find($id);
        $role->update([
            'name' => $data->name,
        ]);
        $role->permissions()->sync($data->permissions_id);
    }
    function delete($id){
        $role = $this->find($id);
        $role->permissions()->detach();
        $role->delete();
    }
}