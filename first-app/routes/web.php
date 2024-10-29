<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('account')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('account.login');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::get('/register', [LoginController::class, 'register'])->name('account.register');
        Route::post('/registerdata', [LoginController::class, 'registerdata'])->name('account.registerdata');
        Route::get('/otp', [LoginController::class, 'OTPView'])->name('account.otp');
        Route::post('/otpconfig', [LoginController::class, 'otpconfig'])->name('account.otpconfig');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [LoginController::class, 'logout'])->name('account.logout');
    });
});

Route::prefix('products')->middleware(['auth'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::get('/EmailSend', [MailController::class, 'sendEmail'])->name('sendEmail');
