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