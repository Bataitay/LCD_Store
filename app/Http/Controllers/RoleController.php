<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Role\RoleServiceInterface;
use Illuminate\Http\Request;

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
        $roles = $this->roleService->all($request);
        $params = [
            'roles' => $roles,
        ];
        return view('back-end.role.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
    public function store(Request $request)
    {
        $this->roleService->create($request);
        return  redirect()->route('role.index');
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
        $role = $this->roleService->find($id);
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
    public function update(Request $request, $id)
    {
        $this->roleService->update($id, $request);
        return  redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->roleService->delete($id);
       return  redirect()->route('role.index');
    }
}
