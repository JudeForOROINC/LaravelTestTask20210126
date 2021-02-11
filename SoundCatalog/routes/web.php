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




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

// :RoleName,PermissionName
Route::group(['middleware' => \App\Http\Middleware\CheckRole::class . ':Admin,Approve instruction'], function () {
    Route::resource('/admin-home', \App\Http\Controllers\AdminHomeController::class);
    Route::resource('/soundcategory', \App\Http\Controllers\SoundCategoryController::class);
});


Route::resource('/sound', \App\Http\Controllers\SoundController::class);

