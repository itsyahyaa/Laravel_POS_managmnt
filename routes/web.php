<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
// creating route for all controllers

Route::resource('/orders', OrderController::class);
Route::resource('/product', ProductController::class);
Route::get('/barcode', [ProductController::class, 'GetProductBarCodes'])->name('products.barcode');
Route::resource('/suppliers', SupplierController::class);
Route::resource('/users', UserController::class);
Route::resource('/companies', CompanyController::class);
Route::resource('/transactions', TransactionController::class);
Route::resource('/sections', SectionController::class); // route name is (sections.index)

Route::get('receipt', function () {
    return view('report.receipt');
});