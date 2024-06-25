<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::put('customers/{customer}/toggle-status', [CustomerController::class, 'toggleStatus'])->name('toggle-status');

// Customer
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::get('/edit/{customer}', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/update/{customer}', [CustomerController::class, 'update'])->name('update');
    Route::delete('/destroy/{customer}', [CustomerController::class, 'delete'])->name('destroy');
});
