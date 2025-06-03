<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\profileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::view('/', 'homepage')
    ->name('homepage');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::get('profile', [profileController::class, 'showProfile'])
        ->middleware(['auth'])
        ->name('profile');

    Route::prefix('lecture')->group(function() {
        Route::get('/', [LectureController::class, 'indexLecture'])
        ->name('lecture.index');
        Route::get('/create', [LectureController::class, 'createLecture'])
        ->name('lecture.create');
        Route::post('/create', [LectureController::class, 'storeLecture'])
        ->name('lecture.store');
        Route::get('/{id}', [LectureController::class, 'showLecture'])
        ->name('lecture.show');
    });

    Route::post('/api/generateCode', [LectureController::class, 'codeCheck'])
        ->name('code.Check');
});




require __DIR__ . '/auth.php';
