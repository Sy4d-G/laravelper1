<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'loginWeb']);
Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');

// Route Web terlindungi oleh Middleware 'auth' dan Custom Middleware 'admin'
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => 'Dashboard Admin Eksklusif');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile']);
    Route::get('/pos/history', fn() => 'Riwayat Transaksi')->name('pos.history');
    Route::get('/pos', fn() => 'Halaman Transaksi POS')->name('pos.index');
    Route::get('/categories', fn() => 'Manajemen Kategori')->name('categories.index');
    Route::get('/products', fn() => 'Manajemen Produk')->name('products.index');
    Route::get('/reports/sales', fn() => 'Laporan Penjualan')->name('report.sales');
    
    // Contoh update post menggunakan policy
    Route::put('/posts/{post}', [PostController::class, 'update']);
});
