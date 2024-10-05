<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Pages (auth needed)
Route::middleware('auth:api-student')->prefix('/pages')->group(function () {
    Route::get('/home', [PageController::class, 'home']);

    // `/pages/sources` related routes
    Route::prefix('/sources')->group(function () {
        Route::get('/', [PageController::class, 'sources']);
        Route::get('/{slug}', [PageController::class, 'lessons']);
        Route::get('/lessons/{slug}/sliders', [PageController::class, 'sliders']);
        Route::get('/lessons/{slug}/videos', [PageController::class, 'videos']);
        Route::get('/lessons/{slug}/flashcards', [PageController::class, 'flashcards']);
    });
    Route::get('/weekly-schedule', [PageController::class, 'weeklySchedule']);
    Route::get('/notifications', [PageController::class, 'notifications']);
    Route::get('/settings', [PageController::class, 'settings']);

    // `/pages/chat` related routes
    Route::prefix('/chat')->group(function () {
        Route::get('/', [PageController::class, 'chat']);
        Route::get('/{identifier}', [PageController::class, 'messages']);
    });
});

// Pages (no auth needed)
Route::prefix('/pages')->group(function () {
    Route::get('/about-us', [PageController::class, 'aboutUs']);
    Route::get('/contact-us', [PageController::class, 'contactUs']);
});
