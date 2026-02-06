<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\IsMerchant; 
use App\Http\Middleware\IsCustomer; 

// Halaman Utama
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('landing');
Route::get('/invoice/{invoice_number}', [\App\Http\Controllers\OrderController::class, 'showInvoice'])->name('invoice.show')->middleware('auth');

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
        Route::get('/profile', [MerchantController::class, 'showProfile'])->name('merchant.profile');
        Route::post('/profile', [MerchantController::class, 'updateProfile'])->name('merchant.profile.update');
        Route::post('/menu', [MerchantController::class, 'storeMenu'])->name('merchant.menu.store');
        Route::get('/menu/{id}/edit', [MerchantController::class, 'editMenu'])->name('merchant.menu.edit');
        Route::put('/menu/{id}', [MerchantController::class, 'updateMenu'])->name('merchant.menu.update');
        Route::delete('/menu/{id}', [MerchantController::class, 'deleteMenu'])->name('merchant.menu.delete');
        Route::post('/order/{id}/accept', [MerchantController::class, 'acceptOrder'])->name('merchant.order.accept');
        Route::post('/order/{id}/complete', [MerchantController::class, 'completeOrder'])->name('merchant.order.complete');
    });

    // === ROUTE UNTUK CUSTOMER ===
    Route::middleware(IsCustomer::class)->prefix('customer')->group(function () {
        Route::get('/dashboard', [OrderController::class, 'index'])->name('customer.dashboard');
        Route::post('/order', [OrderController::class, 'store'])->name('customer.order.store');
        Route::post('/order/{id}/cancel', [OrderController::class, 'cancel'])->name('customer.order.cancel');
        Route::get('/orders', [OrderController::class, 'myOrders'])->name('customer.orders');
    });

});