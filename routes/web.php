<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BucketController;
use App\Http\Controllers\BallController;
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

Route::get('/',[BucketController::class, 'welcome'])->name('welcome');

Route::get('/add_bucket',[BucketController::class, 'index'])->name('add_bucket');
Route::post('/store_bucket',[BucketController::class, 'store'])->name('store_bucket');

Route::get('/add_ball',[BallController::class, 'index'])->name('add_ball');
Route::post('/store_ball',[BallController::class, 'store'])->name('store_ball');

Route::get('/bucket_suggestion',[BallController::class, 'bucket_suggestion'])->name('bucket_suggestion');
Route::post('/check_suggestion',[BallController::class, 'check_suggestion'])->name('check_suggestion');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
