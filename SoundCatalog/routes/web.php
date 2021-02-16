<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [App\Http\Controllers\SoundController::class, 'index']);
//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/complaints', [App\Http\Controllers\SoundСomplaintController::class, 'index'])->name('complaints_main');


Route::get('/complaints/soundComplaints/{id}', function($id){
    $sff = new \App\Http\Controllers\SoundСomplaintController();
    return $sff->soundComplaints($id);
})->name('complaints.soundComplaints');

Route::get('/complaints/create/{soundId}', function($soundId){
    $sff = new \App\Http\Controllers\SoundСomplaintController();
    return $sff->create($soundId);
})->name('complaints.create');


Route::resource('/complaints', \App\Http\Controllers\SoundСomplaintController::class);

Route::patch('/complaints/{complaint}', [\App\Http\Controllers\SoundСomplaintController::class, 'update'])->middleware(
    \App\Http\Middleware\CheckRole::class . ':Admin'
)->name('complaints.update');


Route::group(['middleware' => \App\Http\Middleware\CheckRole::class . ':Admin'], function () {
    Route::resource('/admin-home', \App\Http\Controllers\AdminHomeController::class);
    Route::resource('/soundcategory', \App\Http\Controllers\SoundCategoryController::class);
});


Route::resource('/sound', \App\Http\Controllers\SoundController::class);
Route::post('/sound/search_ajax', [\App\Http\Controllers\SoundController::class, 'searchAjax'])->name('sound.search.ajax');



Route::resource('users', UserController::class);
