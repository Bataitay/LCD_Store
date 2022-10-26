<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Services\Permission\PermissionServiceInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    protected $permissionService;
    function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $childPermissions = $this->permissionService->getChildPermissions();
        $childPermissions_id = [];
        foreach($childPermissions as $childPermission){
            array_push($childPermissions_id, $childPermission->id);
        }
        $role = Role::create([
            'name' => 'SuperAdmin',
        ]);
        $role->permissions()->attach($childPermissions_id);
        $role = Role::create([
            'name' => 'Writer',
        ]);
        $role = Role::create([
            'name' => 'Manager',
        ]);
        $role = Role::create([
            'name' => 'Admin',
        ]);
    }
}
