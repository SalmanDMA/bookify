<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route grup untuk semua rute yang memerlukan otentikasi
Route::middleware('auth')->group(function () {
    // Rute verifikasi email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/orders');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        toast('Email verification link sent!', 'success');
        return redirect()->route('verification.notice');
    })->middleware('throttle:6,1')->name('verification.send');

    // Rute untuk halaman yang sudah terverifikasi
    Route::get('/orders', function () {
        return 'orders, halaman verified';
    })->middleware('verified')->name('orders');
});

// Rute untuk auth
Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('forgot-password.post');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('reset-password')->middleware('verified');
    Route::post('/reset-password', [AuthController::class, 'resetPasswordPost'])->name('reset-password.post')->middleware('verified');
});

// Rute beranda
Route::get('/', function () {
    return view('welcome');
})->name('home');
