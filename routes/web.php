<?php

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\landingpage;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('landingpage/home');
// });

Route::get('/', [landingpage::class, 'home'])->name('home');
Route::get('/katalog', [landingpage::class, 'katalog'])->name('katalog');

Route::get('/admin/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/prosesregister', [UserController::class, 'registerStore'])
    ->middleware('throttle:10,1')
    ->name('register.store');

Route::get('/verifikasi', [UserController::class, 'verificationNotice'])->name('verification.notice');
Route::post('/verifikasi', [UserController::class, 'verificationVerify'])
    ->middleware('throttle:10,1')
    ->name('verification.verify');
Route::post('/verifikasi/kirim-ulang', [UserController::class, 'verificationResend'])
    ->middleware('throttle:5,1')
    ->name('verification.resend');

// Login: method beda untuk GET dan POST
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/proseslogin', [UserController::class, 'loginStore'])
    ->middleware('throttle:10,1')
    ->name('login.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// Route::middlewareprefix('admin')->name('admin.')->group(function () {
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/admin/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/admin/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
// });