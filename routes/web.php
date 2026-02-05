<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\IsMerchant; 
use App\Http\Middleware\IsCustomer; 

// Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group Routes untuk yang sudah Login
Route::middleware('auth')->group(function () {
    
    // === ROUTE UNTUK MERCHANT ===
    Route::middleware(IsMerchant::class)->prefix('merchant')->group(function () {
        Route::get('/dashboard', [MerchantController::class, 'index'])->name('merchant.dashboard');
        Route::post('/menu', [MerchantController::class, 'storeMenu'])->name('merchant.menu.store');
    });

    // === ROUTE UNTUK CUSTOMER ===
    Route::middleware(IsCustomer::class)->prefix('customer')->group(function () {
        Route::get('/dashboard', [OrderController::class, 'index'])->name('customer.dashboard');
        Route::post('/order', [OrderController::class, 'store'])->name('customer.order.store');
        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('customer.orders');
    });

});