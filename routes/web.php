<?php

use Illuminate\Support\Facades\Route;
use App\Models\Service;
use App\Models\Customer_project;
use App\Models\Service_feature;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    $data['services_f'] = Service::where('active',1)->take(5)->get();

    return view('layouts.mainPage')->with('data',$data);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin_index'])->name('admin');

Route::get('/about', function () {
    $data['services_f'] = Service::where('active',1)->take(5)->get();

    return view('about_page')->with('data',$data);
})->name('about');


Route::get('/contact', function () {
    $data['services_f'] = Service::where('active',1)->take(5)->get();

    return view('contact_page')->with('data',$data);
})->name('contact');


Route::get('/customer', function () {
    $data['services_f'] = Service::where('active',1)->take(5)->get();

    $data['services'] = Service::where('active',1)->get();

    return view('layouts.customer_page')->with('data',$data);
})->name('customer')->middleware('auth');


Route::get('/services', function () {
    $data['services_f'] = Service::where('active',1)->take(5)->get();

    $data['services'] = Service::where('active',1)->get();

    return view('layouts.services_page')->with('data',$data);
})->name('services');

Route::post('/add-service', [App\Http\Controllers\HomeController::class, 'add_service'])->name('add-service');

Route::post('/request-service', [App\Http\Controllers\HomeController::class, 'request_service'])->name('request-service');

Route::post('/update-project', [App\Http\Controllers\HomeController::class, 'update_project'])->name('update-project');

Route::post('/close-project', [App\Http\Controllers\HomeController::class, 'close_project'])->name('close-project');

Route::get('/edit-service/{service_id}',[App\Http\Controllers\HomeController::class, 'edit_service'])->name('edit-service');

Route::get('/view-service/{service_id}',[App\Http\Controllers\HomeController::class, 'view_service'])->name('view-service');

Route::get('/view-project/{project_id}',[App\Http\Controllers\HomeController::class, 'view_project'])->name('view-project');

Route::post('/delete-service',[App\Http\Controllers\HomeController::class, 'delete_service'])->name('delete-service');

Route::post('/save-service',[App\Http\Controllers\HomeController::class, 'save_service'])->name('save-service');

Route::post('/admin/manage-staff', function () {
    $data['services_f'] = Service::where('active',1)->take(5)->get();


    return view('admin.manage_staff')->with('data',$data);
})->name('manage_s')->middleware('auth');



