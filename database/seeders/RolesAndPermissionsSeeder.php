<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $addCategory = "add category";
        $editCategory = "edit category";
        $deleteCategory = "delete category";
        $viewCategory = "view category";
        $addPlant = "add plant";
        $editPlant = "edit plant";
        $deletePlant = "delete plant";
        $viewPlants = "view plants";
        $showPlant = "show plant";
        $updateProfile = "update profile";
        $addRole = "add role";
        $editRole = "edit role";
        $deleteRole = "delete role";
        $showRole = "show role";
        $addPermission = "add permission";
        $updatePermission = "update permission";
        $deletePermission = "delete permission";
        $viewPermission = "view permission";
        $grantPermission = "grant permission";
        $assignRole = "assign role";
        
        Permission::create(["name" => $addCategory,'guard_name' => 'api']);
        Permission::create(["name" => $editCategory,'guard_name' => 'api']);
        Permission::create(["name" => $deleteCategory,'guard_name' => 'api']);
        Permission::create(["name" => $viewCategory,'guard_name' => 'api']);
        Permission::create(["name" => $addPlant,'guard_name' => 'api']);
        Permission::create(["name" => $editPlant,'guard_name' => 'api']);
        Permission::create(["name" => $deletePlant,'guard_name' => 'api']);
        Permission::create(["name" => $viewPlants,'guard_name' => 'api']);
        Permission::create(["name" => $showPlant,'guard_name' => 'api']);
        Permission::create(["name" => $updateProfile,'guard_name' => 'api']);
        Permission::create(["name" => $addRole,'guard_name' => 'api']);
        Permission::create(["name" => $editRole,'guard_name' => 'api']);
        Permission::create(["name" => $deleteRole,'guard_name' => 'api']);
        Permission::create(["name" => $showRole,'guard_name' => 'api']);
        Permission::create(["name" => $assignRole,'guard_name' => 'api']);
        Permission::create(["name" => $addPermission,'guard_name' => 'api']);
        Permission::create(["name" => $updatePermission,'guard_name' => 'api']);
        Permission::create(["name" => $deletePermission,'guard_name' => 'api']);
        Permission::create(["name" => $viewPermission,'guard_name' => 'api']);
        Permission::create(["name" => $grantPermission,'guard_name' => 'api']);
        

        $admin = "Admin";
        $vendor = "vendor";
        $customer = "customer";

        Role::create(["name" => $admin,'guard_name' => 'api'])->givePermissionTo(Permission::all());
        Role::create(["name" => $vendor,'guard_name' => 'api'])->givePermissionTo([
            $addPlant,
            $editPlant,
            $deletePlant,
            $viewPlants,
            $showPlant,
            $updateProfile,
        ]);
        Role::create(["name" => $customer,'guard_name' => 'api'])->givePermissionTo([
            $viewPlants,
            $showPlant,
            $updateProfile,
        ]);
        //
    }
}
