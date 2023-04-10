<?php

use App\Http\Controllers\Api\Admin\Hospital\ApiAgentPatientController;
use App\Http\Controllers\Api\Admin\Hospital\ApiBranchController;
use App\Http\Controllers\Api\Admin\Hospital\ApiHospitalController;
use App\Http\Controllers\Api\Admin\Hospital\ApiPatientPrivateController;
use App\Http\Controllers\Api\Admin\Hospital\ApiSubscriptionController;
use App\Http\Controllers\Api\Admin\Others\ApiAgentServiceController;
use App\Http\Controllers\Api\Admin\Others\ApiCommuneController;
use App\Http\Controllers\Api\Admin\Others\ApiCompanyController;
use App\Http\Controllers\Api\Admin\Others\ApiCurrencyController;
use App\Http\Controllers\Api\Admin\Others\ApiPatientTypeController;
use App\Http\Controllers\Api\Admin\Others\ApiRateController;
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
    Route::resource('branch', ApiBranchController::class);
    Route::resource('commune', ApiCommuneController::class);
    Route::resource('service-agent', ApiAgentServiceController::class);
    Route::resource('company', ApiCompanyController::class);
    Route::resource('subscription', ApiSubscriptionController::class);
    Route::resource('patient-private', ApiPatientPrivateController::class);
    Route::resource('patient-subscribe', ApiPatientPrivateController::class);
    Route::resource('agent-patient', ApiAgentPatientController::class);
    Route::resource('patient-type', ApiPatientTypeController::class);
    Route::resource('rate', ApiRateController::class);
    Route::resource('currency', ApiCurrencyController::class);


    //Change status routes
    Route::put('/branch/status/{id}', [ApiBranchController::class, 'changeStatus']);
    Route::put('/role/status/{id}', [ApiRoleController::class, 'changeStatus']);
    Route::put('/user/status/{id}', [ApiUserController::class, 'changeStatus']);
    Route::put('/hospital/status/{id}', [ApiHospitalController::class, 'changeStatus']);
    Route::put('/hospital/logo/{id}', [ApiHospitalController::class, 'updateLogo']);
    Route::put('/subscription/status/{id}', [ApiSubscriptionController::class, 'changeStatus']);
    Route::put('/rate/status/{id}', [ApiRateController::class, 'changeStatus']);

    //Search routes
    Route::get('/users/search',[ApiUserController::class,'searchUser']);

});
