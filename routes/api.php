<?php

use App\Http\Controllers\Api\Admin\Hospital\ApiHospitalController;
use App\Http\Controllers\Api\Admin\User\ApiRoleController;
use App\Http\Controllers\Api\Admin\User\ApiUserController;
use App\Http\Controllers\Api\Auth\LogingController;
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
|Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::post('login', LogingController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('role', ApiRoleController::class);
    Route::resource('user', ApiUserController::class);
    Route::resource('hospital', ApiHospitalController::class);
    Route::get('/role/status/{id}', [ApiRoleController::class, 'changeStatus']);
    Route::get('/hospital/status/{id}', [ApiHospitalController::class, 'changeStatus']);
    Route::get('/user/{id}/status', [ApiUserController::class, 'changeStatus']);
});
