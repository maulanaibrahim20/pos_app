<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\{DashboardController, LoginController, LogoutController};

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('~admin')->middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::prefix('~admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
});
