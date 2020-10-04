<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('products', ProductController::class)->middleware(['auth:sanctum', 'verified']);

Route::put('product/status/{id}', [ProductController::class, 'status'])->middleware(['auth:sanctum', 'verified']);

Route::get('product-list', [CustomerController::class, 'index'])->name('product.list')->middleware(['auth:sanctum', 'verified']);

Route::post('customer/register', [CustomerController::class, 'store'])->name('customer.store');
