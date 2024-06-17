<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
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
    return redirect()->route('home')->with('success', 'Welcome to Invesis App.');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::resource('pages', PageController::class);
    });
});

Route::get('/checkout/{page}', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/payment/success', [App\Http\Controllers\CheckoutController::class, 'success'])->name('payment.success');
Route::get('/payment/failure', [App\Http\Controllers\CheckoutController::class, 'failure'])->name('payment.failure');
