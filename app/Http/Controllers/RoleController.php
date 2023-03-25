<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles = Role::all();

        return response()->json([
            'data' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);

        return response()->json([
            'message' => 'Role created successfully',
            'data' => $role
        ], 201);
    }

    public function update(Request $request, Role $role)
    {
        $role->name = $request->name;
        $role->save();

        return response()->json([
            'message' => 'Role updated successfully',
            'data' => $role
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'message' => 'Role deleted successfully'
        ]);
    }

    public function grantPermission(Request $request, Role $role)
    {
        $permission = Permission::find($request->permission_id);
        
        if (!$permission) {
            return response()->json([
                'message' => 'Permission not found'
            ], 404);
        }
        
        $role->givePermissionTo($permission);
        
        return response()->json([
            'message' => 'Permission granted to role successfully',
            'data' => $role
        ]);
    }
}
