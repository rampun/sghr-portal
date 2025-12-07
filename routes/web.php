<?php

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;



Route::middleware('web')->group(function () {

    Route::get('/', [LandingController::class, 'index'])->name('index');

    // Route::prefix('jobs')->name('jobs.')->group(function () {

    //     // Route::get('/{id}', [LandingController::class, 'show'])->name('show');
    //     // Route::get('/export/csv', [LandingController::class, 'export'])->name('export');
    //     // Route::get('/statistics', [LandingController::class, 'statistics'])->name('statistics');
    // });

    // Home route redirects to jobs
    // Route::redirect('/', '/jobs');
});
