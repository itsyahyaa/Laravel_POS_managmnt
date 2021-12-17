<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TransactionController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');
// creating route for all controllers

Route::resource('/orders', [OrderController::class, 'index']);
Route::resource('/products', [ProductController::class, 'index']);
Route::resource('/suppliers', [SupplierController::class, 'index']);
Route::resource('/users', [UserController::class, 'index']);
Route::resource('/companies', [CompanyController::class, 'index']);
Route::resource('/transactions', [TransactionController::class, 'index']);

