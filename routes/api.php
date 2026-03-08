<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectStageController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Admin\InvestorManagementController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\InvestorController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::prefix('public')->group(function () {
    Route::get('home', [PublicController::class , 'getHome']);
    Route::get('seo', [PublicController::class , 'getSeo']);
    Route::get('projects', [PublicController::class , 'getProjects']);
    Route::get('projects/{slug}', [PublicController::class , 'getProject']);
    Route::post('contact', [PublicController::class , 'postContact']);

    // Deployment & Fix Helpers
    Route::get('run-migrations', [PublicController::class , 'runMigrations']);
    Route::get('run-demo-seeder', [PublicController::class , 'runDemoSeeder']);
    Route::get('seed-settings', [PublicController::class , 'seedSettings']);
    Route::get('read-logs', [PublicController::class , 'readLogs']);
    Route::get('fix-admin', [PublicController::class , 'fixAdminRole']);
    Route::get('clear-cache', [PublicController::class , 'clearCache']);
});

Route::middleware([\Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class])->group(function () {
    // Admin Auth
    Route::prefix('auth')->group(function () {
            Route::post('register', [AuthController::class , 'register']);
            Route::post('login', [AuthController::class , 'login']);
            Route::post('logout', [AuthController::class , 'logout'])->middleware('auth:sanctum');
            Route::get('user', [AuthController::class , 'user'])->middleware('auth:sanctum');
        }
        );

        // Admin CRUD (Protected by Sanctum + Role=Admin)
        Route::prefix('admin')->middleware(['auth:sanctum', 'admin'])->group(function () {
            Route::get('dashboard/stats', [\App\Http\Controllers\Admin\DashboardController::class , 'stats']);

            Route::apiResource('products', ProductController::class)->except(['update']);
            Route::post('products/{product}', [ProductController::class , 'update']);

            Route::apiResource('team', TeamController::class)->except(['update']);
            Route::post('team/{team}', [TeamController::class , 'update']);

            Route::apiResource('projects', ProjectController::class)->except(['update']);
            Route::post('projects/{project}', [ProjectController::class , 'update']);

            Route::apiResource('stages', ProjectStageController::class);
            Route::apiResource('revenues', \App\Http\Controllers\Admin\ProjectRevenueController::class)->except(['update', 'show']);
            Route::apiResource('investments', InvestmentController::class)->only(['index', 'show']);
            Route::get('investors', [InvestorManagementController::class , 'index']);

            // Payments (Requires investor login)
            Route::post('payment/stripe/intent', [PaymentController::class , 'createStripeIntent']);
            Route::post('payment/capture', [PaymentController::class , 'captureInvestment']);

            Route::get('messages', [MessageController::class , 'index']);
            Route::get('settings', [SettingController::class , 'index']);
            Route::put('settings', [SettingController::class , 'update']);
            Route::post('settings/logo', [SettingController::class , 'uploadLogo']);
            Route::post('settings/og-image', [SettingController::class , 'uploadOgImage']);
            Route::post('settings/favicon', [SettingController::class , 'uploadFavicon']);
        }
        );

        // Investor Protected Routes
        Route::prefix('investor')->middleware('auth:sanctum')->group(function () {
            Route::get('investments', [InvestorController::class , 'getInvestments']);
            Route::post('investments/{id}/sign', [InvestorController::class , 'signContract']);
        }
        );
    });
