<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Role\RoleServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    protected $permissionService;
    protected $roleService;
    public function __construct(
        PermissionServiceInterface $permissionService, 
        RoleServiceInterface $roleService
        )
        {
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        if (Gate::denies('List_Role', 'List_Role')) {
            abort(403);
        }
        $roles = $this->roleService->getAllWithPaginateLatest($request);
        $params = [
            'roles' => $roles,
        ];
        // dd($roles);
        return view('back-end.role.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('Add_Role', 'Add_Role')) {
            abort(403);
        }
        $parentPermissions = $this->permissionService->getParentPermissions();
        $params = [
            'parentPermissions' => $parentPermissions,
        ];
        return view('back-end.role.add', $params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if (Gate::denies('Add_Role', 'Add_Role')) {
            abort(403);
        }
        $this->roleService->create($request);
        $notification = array(
            'message' => 'Added role successfully',
            'alert-type' => 'success'
        );
        $params = [
            'notification' => $notification
        ];
        return  redirect()->route('role.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('Edit_Role', 'Edit_Role')) {
            abort(403);
        }
        $role = $this->roleService->find($id);
        if($role->id == 1){
            abort(403);
        }
        $parentPermissions = $this->permissionService->getParentPermissions();
        $permissionChecked = $role->permissions;
        $params = [
            'role' => $role,
            'parentPermissions' => $parentPermissions,
            'permissionChecked' => $permissionChecked,
        ];
        return view('back-end.role.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        if (Gate::denies('Edit_Role', 'Edit_Role')) {
            abort(403);
        }
        $this->roleService->update($id, $request);
        $notification = array(
            'message' => 'Updated role successfully',
            'alert-type' => 'success'
        );
        return  redirect()->route('role.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Delete_Role', 'Delete_Role')) {
            abort(403);
        }
        $role = $this->roleService->find($id);
        if($role->id == 1){
            abort(403);
        }
        $this->roleService->delete($id);
        $notification = array(
        'message' => 'Deleted role successfully',
        'alert-type' => 'success'
    );
       return response()->json($role);
    }
    public function getTrashed()
    {
        if (Gate::denies('List_Role', 'List_Role')) {
            abort(403);
        }
        $roles = $this->roleService->getTrashed();
        $params = [
            'roles' => $roles,
        ];
        return view('back-end.role.sorfDelete', $params);
    }
    public function restore($id)
    {
        if (Gate::denies('Delete_Role', 'Delete_Role')) {
            abort(403);
        }
        $this->roleService->restore($id);
        $notification = array(
            'message' => 'Restore role successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.getTrashed')->with($notification);
    }
    function force_destroy($id){
        if (Gate::denies('Delete_Role', 'Delete_Role')) {
            abort(403);
        }
        $this->roleService->force_destroy($id);
    }
}
