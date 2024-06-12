<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\http\Middleware\IsSuperAdmin;
use App\http\Middleware\IsAdmin;
use App\http\Middleware\IsAnggota;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/get-user/{id}', [AnggotaController::class, 'getUser']);

Route::middleware(['auth', 'verified'])->group(function () {
    //dapat diakses oleh semua role user
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('kategori', KategoriController::class);

    Route::middleware([IsSuperAdmin::class])->group(function () {
        //sidebar yang diakses IsSuperAdmin
        Route::resource('anggota', AnggotaController::class);
        Route::resource('user', UserController::class);
        Route::resource('produk', ProdukController::class);
    });

    Route::middleware([IsAdmin::class])->group(function () {
        //sidebar yang diakses IsAdmin
    });

    Route::middleware([IsAnggota::class])->group(function () {
        //sidebar yang diakses IsAnggota
    });
});