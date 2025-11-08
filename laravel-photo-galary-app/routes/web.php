<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhotoController::class, 'index'])->name('home'); 
Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store'); 

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('login.process');
