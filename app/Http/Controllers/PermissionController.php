<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //

    public function index()
    {
        $permissions = Permission::all();

        return response()->json([
            'data' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->name]);

        return response()->json([
            'message' => 'Permission created successfully',
            'data' => $permission
        ], 201);
    }
}
