<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\{DashboardController, LoginController, LogoutController, OutletBranchController};

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('~admin')->middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::prefix('~admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::prefix('branch')->controller(OutletBranchController::class)->name('branch.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getData', 'getData')->name('getData');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');

        Route::get('/generate-code', 'generateCode')->name('generateCode');
    });




    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
});
