<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Pages (auth needed)
Route::middleware('auth:api')->prefix('/pages')->group(function () {
    Route::get('/home', [PageController::class, 'home']);
    Route::get('/sources', [PageController::class, 'sources']);
    Route::get('/weekly-schedule', [PageController::class, 'weeklySchedule']);
    Route::get('/notifications', [PageController::class, 'notifications']);
    Route::get('/settings', [PageController::class, 'settings']);
});
