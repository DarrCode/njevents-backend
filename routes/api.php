<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Extras\ExtrasController;
use App\Http\Controllers\Customers\CustomersController;
use App\Http\Controllers\RequestExtra\RequestExtraController;
use App\Http\Controllers\Turns\TurnsController;
use App\Http\Controllers\payments\PaymentsController;
    

// Public routes of authtication
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::group(['middleware' => 'checkRole:admin'], function () {
	Route::get('/administrar-productos', 'ProductController@administrarProductos');
});

// Route::group(['middleware' => 'checkRole:customer'], function () {
	Route::post('/request-extra', [RequestExtraController::class, 'request']);
    Route::get('/all-requests', [RequestExtraController::class, 'index']);
    Route::get('/my-requests', [RequestExtraController::class, 'myRequests']);
    Route::get('/detail-request/{id}', [RequestExtraController::class, 'detailRequest']);

// });

//CUSTOMERS
Route::post('/save-customer', [CustomersController::class, 'createCustomer']);
Route::get('/customers', [CustomersController::class, 'index']);
Route::get('/customer/{id}', [CustomersController::class, 'detail']);
Route::get('/customer/payments/{id}', [CustomersController::class, 'getPayments']);

//EXTRAS
Route::post('/save-extra', [ExtrasController::class, 'createExtra']);
Route::get('/extras', [ExtrasController::class, 'index']);
Route::get('/extra/{id}', [ExtrasController::class, 'detail']);
Route::get('/extra/payments/{id}', [ExtrasController::class, 'getPayments']);

//TURNS
Route::get('/extras-turns', [TurnsController::class, 'index']);


//PAYMENTS
Route::get('/extras-payments', [PaymentsController::class, 'index']);



