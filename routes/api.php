<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Pages (auth needed)
Route::middleware('auth:api-student')->prefix('/pages')->group(function () {
    Route::get('/home', [PageController::class, 'home']);

    // `/pages/sources` related routes
    Route::prefix('/sources')->group(function () {
        Route::get('/', [PageController::class, 'sources']);
        Route::get('/{subject}', [PageController::class, 'lessons']);
    });
    Route::get('/weekly-schedule', [PageController::class, 'weeklySchedule']);
    Route::get('/notifications', [PageController::class, 'notifications']);
    Route::get('/settings', [PageController::class, 'settings']);

    // `/pages/chat` related routes
    Route::prefix('/chat')->group(function () {
        Route::get('/history', [PageController::class, 'chat']);
        Route::get('/{identifier}', [PageController::class, 'messages']);
    });

    // `/pages/homework` related routes
    Route::get('/homework', [PageController::class, 'homework']);

    // `/pages/quiz` related routes
    Route::get('/quiz', [PageController::class, 'quiz']);
});

// Pages (no auth needed)
Route::prefix('/pages')->group(function () {
    Route::get('/about-us', [PageController::class, 'aboutUs']);
    Route::get('/contact-us', [PageController::class, 'contactUs']);
});

// Student Auth
Route::prefix('/auth')->group(function () {
    Route::post('/login', [StudentController::class, 'login']);
    Route::post('/logout', [StudentController::class, 'logout'])->middleware('auth:api-student');
});

// Homework
Route::prefix('/homework')->group(function () {

});

// Quiz
Route::prefix('/quiz')->group(function () {

});

// Chat
Route::middleware('auth:api-student')->prefix('/chat')->group(function () {
    Route::post('/{type}', [ChatController::class, 'newChat'])->where([
        'type' => 'casual|quiz'
    ]);
    Route::post('/{identifier}/message', [ChatController::class, 'sendMessage']);
});
