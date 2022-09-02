<?php

namespace Database\Seeders;

use App\Services\Permission\PermissionServiceInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected $permissionService;
    
    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    
    public function run()
    {
        $parentNameGroups = [
            'Categories',
            'Products',
            'Users',
        ];
        foreach($parentNameGroups as $parentNameGroup){
            $parentGroup =  $this->permissionService->create([
                'name' => $parentNameGroup,
                'group_name' => $parentNameGroup,
                'group_key' => 0,
            ]);
            $this->permissionService->create([
                'name' => 'List ' . $parentNameGroup,
                'group_name' => 'List_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
            $this->permissionService->create([
                'name' => 'Show ' . $parentNameGroup,
                'group_name' => 'Show_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
            $this->permissionService->create([
                'name' => 'Add ' . $parentNameGroup,
                'group_name' => 'Add_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
            $this->permissionService->create([
                'name' => 'Edit ' . $parentNameGroup,
                'group_name' => 'Edit_'.$parentNameGroup,
                'group_key' => $parentGroup->id,
            ]);
        }
    }
}
