<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::prefix('public')->group(function () {
    Route::get('home', [PublicController::class , 'getHome']);
    Route::get('seo', [PublicController::class , 'getSeo']);
    Route::post('contact', [PublicController::class , 'postContact']);
    Route::get('seed-settings', function () {
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'SettingSeeder']);
            return 'Settings Seeded Successfully!';
        }
        );
    });

// Admin Auth
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class , 'login']);
    Route::post('logout', [AuthController::class , 'logout'])->middleware('auth:sanctum');
    Route::get('user', [AuthController::class , 'user'])->middleware('auth:sanctum');
});

// Admin CRUD (Protected by Sanctum)
Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('dashboard/stats', [\App\Http\Controllers\Admin\DashboardController::class , 'stats']);
    Route::apiResource('products', ProductController::class)->except(['update']);
    Route::post('products/{product}', [ProductController::class , 'update']);
    Route::apiResource('team', TeamController::class)->except(['update']);
    Route::post('team/{team}', [TeamController::class , 'update']);
    Route::get('messages', [MessageController::class , 'index']);
    Route::get('settings', [SettingController::class , 'index']);
    Route::put('settings', [SettingController::class , 'update']);
    Route::post('settings/logo', [SettingController::class , 'uploadLogo']);
    Route::post('settings/og-image', [SettingController::class , 'uploadOgImage']);
    Route::post('settings/favicon', [SettingController::class , 'uploadFavicon']);
});
