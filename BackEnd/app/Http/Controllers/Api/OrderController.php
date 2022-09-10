<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD:BackEnd/app/Http/Controllers/Api/OrderController.php
use App\Http\Controllers\Controller;
use App\Services\Order\OrderServiceInterface;
=======
use App\Models\Role;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Role\RoleServiceInterface;
>>>>>>> 719174e (controller role create and store):app/Http/Controllers/RoleController.php
use Illuminate\Http\Request;

class OrderController extends Controller
{
<<<<<<< HEAD:BackEnd/app/Http/Controllers/Api/OrderController.php
    protected $orderService;
    function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
=======
    protected $permissionService;
    protected $roleService;
    public function __construct(
        PermissionServiceInterface $permissionService, 
        RoleServiceInterface $roleService
        )
        {
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
>>>>>>> 719174e (controller role create and store):app/Http/Controllers/RoleController.php
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back-end.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ParentPermissions = $this->permissionService->getParentPermissions();
        $params = [
            'ParentPermissions' => $ParentPermissions,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
