<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
//use App\Helpers;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/sound', [App\Http\Controllers\SoundController::class, 'index'])->name('main');
//Route::get('/', function () {
//    return view('welcome');
//});





Route::resource('/complaints', \App\Http\Controllers\SoundСomplaintController::class);

Route::patch('/complaints/{complaint}', [\App\Http\Controllers\SoundСomplaintController::class, 'update'])->middleware(
    \App\Http\Middleware\CheckRole::class . ':Admin'
)->name('complaints.update');


// :RoleName,PermissionName
Route::group(['middleware' => \App\Http\Middleware\CheckRole::class . ':Admin,Approve instruction'], function () {
    Route::resource('/admin-home', \App\Http\Controllers\AdminHomeController::class);
    Route::resource('/soundcategory', \App\Http\Controllers\SoundCategoryController::class);
});


//Route::get('/complaints/soundComplaints/{id}', function($id){
//    $sff = new \App\Http\Controllers\SoundСomplaintController();
//    return $sff->soundComplaints($id);
//})->name('complaints.soundComplaints');
Route::get('/complaints/create/{soundId}', [App\Http\Controllers\SoundСomplaintController::class, 'create'])->name('complaints.createBySoundId');
Route::get('/complaints/soundComplaints/{id}', [App\Http\Controllers\SoundСomplaintController::class, 'soundComplaints'])->name('complaints.soundComplaints');

Route::resource('/complaints', \App\Http\Controllers\SoundСomplaintController::class);


Route::get('/sound/group_by_categories', [App\Http\Controllers\SoundController::class, 'soundsGroupByCategories'])->name('sound.groupbycategory');
Route::post('/sound/search_ajax_sounds_group_by_category', [\App\Http\Controllers\SoundController::class, 'searchAjaxGroupByCategories'])->name('sound.search.ajax.groupbycategory');
Route::post('/sound/search_ajax', [\App\Http\Controllers\SoundController::class, 'searchAjax'])->name('sound.search.ajax');
// почле всех связанных по смыслу get/post роутов!!!
Route::resource('/sound', \App\Http\Controllers\SoundController::class);




Route::resource('users', UserController::class);
