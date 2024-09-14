<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'can:doctor'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');
    Route::middleware(['auth:sanctum', 'can:admin'])->group(function () {
        Route::post('/user', [UserController::class, 'store'])->name('users.store');
        Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});


Route::match(['get', 'post'], uri: '/login', action: [UserController::class, 'login'])->name('login');
Route::post('/register', action: [UserController::class, 'register'])->name('register');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', action: [UserController::class, 'profile'])->name('profile');
        Route::put('/edit', action: [UserController::class, 'editProfile'])->name('edit-profile');
    });
    Route::get('/logout', action: [UserController::class, 'logout'])->name('logout');
});
