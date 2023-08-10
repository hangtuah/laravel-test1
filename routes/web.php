<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/vehicle', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicle.index');
Route::get('/vehicle/create', [App\Http\Controllers\VehicleController::class, 'create'])->name('vehicle.create');
Route::post('/vehicle/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicle.store');
Route::get('/vehicle/edit/{id}', [App\Http\Controllers\VehicleController::class, 'edit'])->name('vehicle.edit');
Route::post('/vehicle/update/{id}', [App\Http\Controllers\VehicleController::class, 'update'])->name('vehicle.update');
Route::get('/vehicle/delete/{id}', [App\Http\Controllers\VehicleController::class, 'delete'])->name('vehicle.delete');
Route::get('/vehicle/activate/{id}', [App\Http\Controllers\VehicleController::class, 'activate'])->name('vehicle.activate');
