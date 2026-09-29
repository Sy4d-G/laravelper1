<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1;
use App\Http\Controllers\Api\V2;

// --- Autentikasi API (Sanctum) ---
Route::post('/login', [AuthController::class, 'loginApi']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// --- Default API Resource (Pertemuan 7 - Materi 2) ---
Route::get('/posts/latest', [V1\PostController::class, 'latest']);
Route::apiResource('posts', V1\PostController::class);

// --- API Versioning (Pertemuan 7 - Materi 4) ---
Route::prefix('v1')->group(function () {
    Route::get('/posts/latest', [V1\PostController::class, 'latest']);
    Route::apiResource('posts', V1\PostController::class);
});

Route::prefix('v2')->group(function () {
    Route::apiResource('posts', V2\PostController::class);
});
