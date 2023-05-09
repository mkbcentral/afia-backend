<?php

use App\Http\Controllers\Api\Admin\Hospital\ApiAgentPatientController;
use App\Http\Controllers\Api\Admin\Hospital\ApiBranchController;
use App\Http\Controllers\Api\Admin\Hospital\ApiHospitalController;
use App\Http\Controllers\Api\Admin\Hospital\ApiPatientPrivateController;
use App\Http\Controllers\Api\Admin\Hospital\ApiPatientSubscribeController;
use App\Http\Controllers\Api\Admin\Hospital\ApiSubscriptionController;
use App\Http\Controllers\Api\Admin\Others\ApiAgentServiceController;
use App\Http\Controllers\Api\Admin\Others\ApiCommuneController;
use App\Http\Controllers\Api\Admin\Others\ApiCompanyController;
use App\Http\Controllers\Api\Admin\Others\ApiCurrencyController;
use App\Http\Controllers\Api\Admin\Others\ApiPatientTypeController;
use App\Http\Controllers\Api\Admin\Others\ApiRateController;
use App\Http\Controllers\Api\Admin\Tarification\ApiCategoaryTarificationController;
use App\Http\Controllers\Api\Admin\Tarification\ApiConsultationController;
use App\Http\Controllers\Api\Admin\Tarification\ApiTarificationController;
use App\Http\Controllers\Api\Admin\User\ApiRoleController;
use App\Http\Controllers\Api\Admin\User\ApiUserController;
use App\Http\Controllers\Api\Auth\LogingController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Invoices\ApiInvoicePrivateController;
use App\Http\Controllers\Api\Invoices\ApiInvoiceSubscribeController;
use App\Http\Controllers\Api\Invoices\ApiItemsInvoiceController;
use App\Http\Controllers\Api\Invoices\Other\ApiOtherInvoiceController;
use App\Http\Controllers\Api\Invoices\Other\ApiOtherInvoiceSubscribeController;
use App\Http\Controllers\Api\Invoices\Other\ApiTypeOtherInvoiceController;
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
    //Administration routes
    Route::resource('role', ApiRoleController::class);
    Route::resource('user', ApiUserController::class);
    Route::resource('hospital', ApiHospitalController::class);
    Route::resource('branch', ApiBranchController::class);
    Route::resource('commune', ApiCommuneController::class);
    Route::resource('service-agent', ApiAgentServiceController::class);
    Route::resource('company', ApiCompanyController::class);
    //Patient routes CRUD
    Route::resource('subscription', ApiSubscriptionController::class);
    Route::resource('patient-private', ApiPatientPrivateController::class);
    Route::resource('patient-subscribe', ApiPatientSubscribeController::class);
    Route::resource('agent-patient', ApiAgentPatientController::class);
    Route::resource('patient-type', ApiPatientTypeController::class);
    //Tarification routes
    Route::resource('rate', ApiRateController::class);
    Route::resource('currency', ApiCurrencyController::class);
    Route::resource('tarification', ApiTarificationController::class);
    Route::resource('category-tarification', ApiCategoaryTarificationController::class);
    Route::resource('consultation', ApiConsultationController::class);
    //Other invoices routes CRUD
    Route::resource('other-invoice-type', ApiTypeOtherInvoiceController::class);
    Route::resource('other-invoice', ApiOtherInvoiceController::class);
    Route::resource('other-invoice-subscribe', ApiOtherInvoiceSubscribeController::class);

    //Change status routes
    Route::put('/branch/status/{id}', [ApiBranchController::class, 'changeStatus']);
    Route::put('/role/status/{id}', [ApiRoleController::class, 'changeStatus']);
    Route::put('/user/status/{id}', [ApiUserController::class, 'changeStatus']);
    Route::put('/hospital/status/{id}', [ApiHospitalController::class, 'changeStatus']);
    Route::put('/hospital/logo/{id}', [ApiHospitalController::class, 'updateLogo']);
    Route::put('/subscription/status/{id}', [ApiSubscriptionController::class, 'changeStatus']);
    Route::put('/rate/status/{id}', [ApiRateController::class, 'changeStatus']);
    Route::put('/tarification/status/{id}', [ApiTarificationController::class, 'changeStatus']);
    Route::put('/consultation/status/{id}', [ApiConsultationController::class, 'changeStatus']);

    //Search routes
    Route::get('/users/search', [ApiUserController::class, 'searchUser']);
    Route::get('/patient/private/search/', [ApiPatientPrivateController::class, 'searchPatient']);
    Route::get('/patient/subscribe/search/', [ApiPatientSubscribeController::class, 'searchPatient']);
    Route::get('/agent/patient/search/', [ApiAgentPatientController::class, 'searchPatient']);
    //Get first record routes
    Route::get('first-category-tarif', [ApiCategoaryTarificationController::class, 'getFirstRecord']);
    //Get current rate route
    Route::get('current-rate', [ApiRateController::class, 'getCurrentRate']);
    //Request consultation route
    Route::post('/private-make-consultation', [ApiPatientPrivateController::class, 'makeConsultation']);
    Route::post('/subscribe-make-consultation', [ApiPatientSubscribeController::class, 'makeConsultation']);
    Route::post('/agent-make-consultation', [ApiAgentPatientController::class, 'makeConsultation']);

    //Change invoice private status
    Route::put('invoice-private/{id}/status-enable', [ApiPatientPrivateController::class, 'enableStatus']);
    Route::put('invoice-private/{id}/status-disable', [ApiPatientPrivateController::class, 'disablleStatus']);
    //Change invoice subscribe status
    Route::put('invoice-subscribe/{id}/status-enable', [ApiPatientSubscribeController::class, 'enableStatus']);
    Route::put('invoice-subscribe/{id}/status-disable', [ApiPatientSubscribeController::class, 'disablleStatus']);
    //Change invoice agent status
    Route::put('invoice-agent/{id}/status-enable', [ApiAgentPatientController::class, 'enableStatus']);
    Route::put('invoice-agent/{id}/status-disable', [ApiAgentPatientController::class, 'disablleStatus']);
    //Change other invoice private status
    Route::put('other-invoice/{id}/status-enable', [ApiOtherInvoiceController::class, 'enableStatus']);
    Route::put('other-invoice/{id}/status-disable', [ApiOtherInvoiceController::class, 'disablleStatus']);
    //Change other invoice subscribe status
    Route::put('other-invoice-subscribe/{id}/status-enable', [ApiOtherInvoiceSubscribeController::class, 'enableStatus']);
    Route::put('other-invoice-subscribe/{id}/status-disable', [ApiOtherInvoiceSubscribeController::class, 'disablleStatus']);

    //Create items routes
    Route::get('create-items-invoice-private/{id}',[ApiItemsInvoiceController::class,'createInvoiceItems']);
    Route::put('update-qty-items-invoice/{id}',[ApiItemsInvoiceController::class,'updateQtyInvoiceItem']);
    Route::delete('delete-item-invoice-private/{id}',[ApiItemsInvoiceController::class,'deleteIvoiceItem']);
    Route::get('items-invoices-private/{id}',[ApiItemsInvoiceController::class,'getItemsInvoice']);

    //GET ALL INVOICE
    Route::get('invoices-private',[ApiInvoicePrivateController::class,'getInvoices']);
    Route::get('invoices-subscribe',[ApiInvoiceSubscribeController::class,'getInvoices']);
    //GET SPECIFIC INVOICE
    Route::get('invoice-private/{id}',[ApiInvoicePrivateController::class,'show']);
    //GET ITEMS INVOICE

    //GET ITEMS INVOICE

    //Logout User
    Route::get('logout', LogoutController::class);
});
