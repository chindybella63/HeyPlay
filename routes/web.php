<?php

use App\Http\Controllers\landingpage;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('landingpage/home');
// });

Route::get('/', [landingpage::class, 'home'])->name('home');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/prosesregister', [UserController::class, 'register'])->name('register.store');
Route::post('/proseslogin', [UserController::class, 'login'])->name('login.store');