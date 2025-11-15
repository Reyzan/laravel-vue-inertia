<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('auth/Login');
    })->name('login');

    Route::post('/login', [AuthenticationController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthenticationController::class, 'destroy'])->middleware(['auth'])->name('logout');
