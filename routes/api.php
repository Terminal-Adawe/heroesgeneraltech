<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->get('/get-features', [App\Http\Controllers\HomeController::class, 'get_features'])->name('get-features');

Route::middleware('auth:sanctum')->post('/add-feature', [App\Http\Controllers\HomeController::class, 'add_feature'])->name('add-feature');


Route::middleware('auth:sanctum')->get('/get-stages', [App\Http\Controllers\HomeController::class, 'get_stages'])->name('get-stages');

Route::middleware('auth:sanctum')->post('/add-stage', [App\Http\Controllers\HomeController::class, 'add_stage'])->name('add-stage');

Route::middleware('auth:sanctum')->get('/get-customers', [App\Http\Controllers\HomeController::class, 'get_customers'])->name('get-customers');

Route::middleware('auth:sanctum')->get('/get-customer-projects', [App\Http\Controllers\HomeController::class, 'get_customer_projects'])->name('get-customer-projects');

Route::middleware('auth:sanctum')->get('/get-invoice-details', [App\Http\Controllers\ManageOperationsController::class, 'get_invoice_details'])->name('get-invoice-details');

Route::middleware('auth:sanctum')->get('/get-invoices', [App\Http\Controllers\ManageOperationsController::class, 'get_invoices'])->name('get-invoices');

Route::middleware('auth:sanctum')->get('/get-invoice', [App\Http\Controllers\ManageOperationsController::class, 'get_invoice'])->name('get-invoice');

Route::middleware('auth:sanctum')->post('/add-invoice-details', [App\Http\Controllers\ManageOperationsController::class, 'add_invoice'])->name('add-invoice-details');

Route::middleware('auth:sanctum')->post('/save-invoice-items', [App\Http\Controllers\ManageOperationsController::class, 'save_invoice_item'])->name('save-invoice-items');

Route::middleware('auth:sanctum')->post('/confirm-invoice-save', [App\Http\Controllers\ManageOperationsController::class, 'confirm_invoice_save'])->name('confirm-invoice-save');








