<?php

use App\Http\Controllers\RegisterController;
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
Route::post('/user-register', action: [UserController::class, 'register'])->name('user-register');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', action: [UserController::class, 'profile'])->name('profile');
        Route::put('/edit', action: [UserController::class, 'editProfile'])->name('edit-profile');
    });
    Route::get('/logout', action: [UserController::class, 'logout'])->name('logout');
});

Route::prefix('/register')->middleware('auth:sanctum')->group(function () {
    Route::get('/', action: [RegisterController::class,'index'])->name('index');
    Route::get('/{id}', action: [RegisterController::class,'show'])->name('show');
    Route::middleware('can:person')->post('/', action: [RegisterController::class,'store'])->name('store');
    Route::middleware('can:person,admin')->group(function () {
        Route::put('/{id}', action: [RegisterController::class,'update'])->name('update');
        Route::delete('/{id}', action: [RegisterController::class,'destroy'])->name('delete');
    });
});
