<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => Inertia::render('auth/Login'))->name('login');
    Route::post('/login', [AuthenticationController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->post('/logout', [AuthenticationController::class, 'destroy'])->name('logout');
