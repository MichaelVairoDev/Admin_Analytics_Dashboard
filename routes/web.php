<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RevenueAnalyticsController;
use App\Http\Controllers\ProductAnalyticsController;
use App\Http\Controllers\SalesMarketingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/users', [UserManagementController::class, 'index']);
Route::get('/revenue', [RevenueAnalyticsController::class, 'index']);
Route::get('/products', [ProductAnalyticsController::class, 'index']);
Route::get('/sales', [SalesMarketingController::class, 'index']);
