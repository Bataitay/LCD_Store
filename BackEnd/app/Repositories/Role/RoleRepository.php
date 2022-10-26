<?php
namespace App\Repositories\Role;

use App\Models\PermissionRole;
use App\Models\Role;
use App\Models\UserRole;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface{
    function getModel(){
        return Role::class;
    }
    function getAllWithPaginateLatest($request){
        $roles = $this->model->latest()->paginate(10);
        if(isset($request->search)){
            $roles = $this->model->where('name', 'LIKE', '%'.request()->search.'%')->paginate(10);
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
        // $role->permissions()->detach();
        PermissionRole::where('role_id', '=', $id)->delete();
        UserRole::where('role_id', '=', $id)->delete();
        $role->delete();
    }
    public function getTrashed()
    {
        $query = $this->model->onlyTrashed();
        $query->orderBy('id', 'desc');
        $roles = $query->paginate(10);
        return $roles;
    }
    public function restore($id)
    {
        $role = $this->model->withTrashed()->findOrFail($id);
        $role->restore();
        PermissionRole::where('role_id', '=', $id)->withTrashed()->restore();
        UserRole::where('role_id', '=', $id)->withTrashed()->restore();
        return $role;
    }
    public function force_destroy($id)
    {
        try{
            UserRole::where('role_id', '=', $id)->onlyTrashed()->forceDelete();
            PermissionRole::where('role_id', '=', $id)->onlyTrashed()->forceDelete();
            $role = $this->model->onlyTrashed()->findOrFail($id);
            $role->forceDelete();
            return $role;
        }catch(\Exception $e){
            Log::error('error: ' . $e->getMessage() . 'line: ' . $e->getLine(). 'file: ' . $e->getFile());
        }
    }
}
