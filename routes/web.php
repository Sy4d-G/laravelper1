<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [HomeController::class, 'profile']);
    
    // Rute POS & Navigasi
    Route::get('/pos', fn() => 'Halaman Transaksi POS')->name('pos.index');
    Route::get('/pos/history', fn() => 'Riwayat Transaksi')->name('pos.history');
    Route::get('/categories', fn() => 'Manajemen Kategori')->name('categories.index');
    Route::get('/products', fn() => 'Manajemen Produk')->name('products.index');
    Route::get('/reports/sales', fn() => 'Laporan Penjualan')->name('report.sales');
});
