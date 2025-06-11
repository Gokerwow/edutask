<?php

use App\Http\Controllers\LectureController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugasKuisController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::view('/', 'homepage')
    ->name('homepage');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::get('profile', [profileController::class, 'showProfile']) ->
    name('profile');
    Route::post('profile/update', [profileController::class, 'update'])
    ->name('profile.update');

    Route::prefix('lecture')->group(function() {
        Route::get('/', [LectureController::class, 'indexLecture'])
        ->name('lecture.index');
        Route::get('/create', [LectureController::class, 'createLecture'])
        ->name('lecture.create');
        Route::post('/create', [LectureController::class, 'storeLecture'])
        ->name('lecture.store');
        Route::get('/{id}', [LectureController::class, 'showLecture'])
        ->name('lecture.show');
        Route::post('/join', [LectureController::class, 'joinLecture'])
        ->name('lecture.join');

        Route::prefix('{lecture}/materi')->group(function() {
            Route::get('/create', [MateriController::class, 'createMateri'])
                ->name('materi.create');
            Route::post('/create', [MateriController::class, 'storeMateri'])
                ->name('materi.store');
            Route::get('{materi}/update', [MateriController::class, 'editMateri'])
                ->name('materi.edit');
            Route::put('{materi}/update', [MateriController::class, 'updateMateri'])
                ->name('materi.update');
            Route::get('/{materi}', [MateriController::class, 'showMateri'])
                ->name('materi.show');
            Route::get('/{materi}/download', [MateriController::class, 'downloadMateri'])
            ->name('materi.download');
        });

        Route::prefix('{lecture}/tugas')->group(function() {
            Route::get('/create', [TugasController::class, 'createTugas'])
                ->name('tugas.create');
            Route::post('/create', [TugasController::class, 'storeTugas'])
                ->name('tugas.store');
            Route::get('/{tugas}', [TugasController::class, 'showTugas'])
                ->name('tugas.show');
            Route::get('{tugas}/update', [TugasController::class, 'editTugas'])
                ->name('tugas.edit');
            Route::put('{tugas} ', [TugasController::class, 'updateTugas'])
                ->name('tugas.update');

            Route::prefix('{tugas}')->group(function() {
                Route::get('/submit', [SubmissionController::class, 'createSubmission'])
                    ->name('tugas.submit');
                Route::post('/submit', [SubmissionController::class, 'storeSubmission'])
                    ->name('tugas.storeSubmit');
                Route::get('{submission}/update', [SubmissionController::class, 'editSubmission'])
                    ->name('tugas.editSubmit');
                Route::put('{submission}/update', [SubmissionController::class, 'updateSubmission'])
                    ->name('tugas.updateSubmit');
                Route::get('/{submit}/download', [SubmissionController::class, 'downloadSubmit'])
                    ->name('tugas.downloadSubmit');
            });

        });
    });

    Route::post('/api/generateCode', [LectureController::class, 'codeCheck'])
        ->name('code.Check');
});




require __DIR__ . '/auth.php';
