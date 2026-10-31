<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

// Public: everyone can read quotes
Route::get('/', [QuoteController::class, 'index'])->name('home');

// Guests only
Route::middleware('guest')->group(function () {
    Route::get('/signup', fn () => view('Authentication.SignUp', ['page' => 'Sign Up']))->name('signup');
    Route::post('/signup', [SignupController::class, 'store']);

    Route::get('/login', fn () => view('Authentication.LogIn', ['page' => 'Log In']))->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// Logged-in users only
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

    Route::post('/quotes', [QuoteController::class, 'store'])->name('quotes.store');
    Route::put('/quotes/{quote}', [QuoteController::class, 'update'])->name('quotes.update');
    Route::delete('/quotes/{quote}', [QuoteController::class, 'destroy'])->name('quotes.destroy');

    // Extra feature: like / unlike
    Route::post('/quotes/{quote}/like', [LikeController::class, 'toggle'])->name('quotes.like');
});
