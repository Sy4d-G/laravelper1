<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Autentikasi Manual (Login & Logout)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard terlindungi auth
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Rute Data Master khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/categories', fn() => 'Manajemen Kategori')->name('categories.index');
    Route::get('/products', fn() => 'Manajemen Produk')->name('products.index');
    Route::get('/reports/sales', fn() => 'Laporan Penjualan')->name('report.sales');
});

// Rute Kasir & Admin
Route::middleware(['auth', 'role:admin,kasir'])->group(function () {
    Route::get('/pos', fn() => 'Layar Kasir Transaksi')->name('pos.index');
    Route::get('/pos/history', fn() => 'Riwayat Transaksi')->name('pos.history');
});
