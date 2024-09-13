<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', [UserController::class, 'index'])->name('users');
// Route::get('/user/{id}', [UserController::class, 'show'])->name('show_users');

Route::match(['get', 'post'], '/login', action: [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/profile', action: [UserController::class, 'profile'])->name('profile');
    Route::get('/logout', action: [UserController::class, 'logout'])->name('logout');
});
