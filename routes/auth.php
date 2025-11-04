<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('guest')->group(function () {
    Route::get('/login', Inertia::render('auth/Login'))
        ->name('login.get');
    Route::post('/login', [AuthenticationController::class, 'store'])
        ->name('login.post');
});
