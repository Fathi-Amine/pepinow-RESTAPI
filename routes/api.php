<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class,'register']);

Route::group(['middleware' => ['auth:sanctum', 'role:Admin']], function(){
    Route::apiResource('category',CategoryController::class);
    Route::get('roles', [RoleController::class, 'index']);
    Route::post('roles', [RoleController::class, 'store']);
    Route::put('/roles/{role}', [RoleController::class, 'update']);
    Route::delete('/roles/{role}', [RoleController::class, 'destroy']);
    Route::post('roles/{role}/grant-permission', [RoleController::class, 'grantPermission']);
    Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
    Route::post('/permissions', 'PermissionController@store')->name('permissions.store');
});
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('plant',PlantController::class);
    Route::post('/logout', [UserController::class,'logout']);
    Route::post('/refresh', [UserController::class,'refreshToken']);
    Route::put('/update', [UserController::class,'update']);
    Route::put('/reset', [UserController::class,'resetPassword']);
});


