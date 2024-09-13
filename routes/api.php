<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum', 'can:doctor')->group(function () {
//     Route::get('/user', [UserController::class, 'index'])->name('users');
//     Route::get('/user/{id}', [UserController::class, 'show'])->name('show_users');
// });

Route::match(['get', 'post'], uri: '/login', action: [UserController::class, 'login'])->name('login');
Route::post('/register', action: [UserController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('profile')->group(function () {
        Route::get('/', action: [UserController::class, 'profile'])->name('profile');
        Route::put('/edit', action: [UserController::class, 'editProfile'])->name('editProfile');
    });
    Route::get('/logout', action: [UserController::class, 'logout'])->name('logout');
});

