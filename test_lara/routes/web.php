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



Route::resource('/instructions', \App\Http\Controllers\InstructionsController::class);
Route::post('/instructions/search', [\App\Http\Controllers\InstructionsController::class, 'search'])->name('instructions.search');
Route::post('/instructions/ajax_search', [\App\Http\Controllers\InstructionsController::class, 'ajaxSearch'])->name('instructions.ajax.search');
Route::get('/instruction/download/{instruction}', [\App\Http\Controllers\InstructionsController::class, 'fileDownload'])->name('instructions.download');
Route::get('/instruction/preview/{instruction}', [\App\Http\Controllers\InstructionsController::class, 'filePreview'])->name('instructions.preview');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
