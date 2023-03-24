<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlantController;
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
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::apiResource('category',CategoryController::class);
    Route::apiResource('plant',PlantController::class);
    Route::post('/logout', [UserController::class,'logout']);
    Route::post('/refresh', [UserController::class,'refreshToken']);
    Route::put('/update', [UserController::class,'update']);
    Route::put('/reset', [UserController::class,'resetPassword']);
});