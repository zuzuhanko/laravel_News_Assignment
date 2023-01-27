<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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

Route::get('/', [NewsController::class,'main'])->name('main');
Route::get('create',[NewsController::class,'create'])->name('create');
Route::post('insert,',[NewsController::class,'insert'])->name('insert');
Route::get('edit,{id}',[NewsController::class,'edit'])->name('edit');
Route::post('update,{id}',[NewsController::class,'update'])->name('update');
Route::get('delete,{id}',[NewsController::class,'delete'])->name('delete');
Route::get('choose/important',[NewsController::class,'important'])->name('important');
Route::get('choose/normal',[NewsController::class,'normal'])->name('normal');
