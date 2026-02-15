<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SavedJobsController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {

    Route::get('/', [LandingController::class, 'index'])->name('index');

    Route::prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', [JobsController::class, 'index'])->name('index');
        Route::get('/{id}', [JobsController::class, 'show'])->name('show');
    });

    Route::prefix('employers')->name('employers.')->group(function () {
        Route::get('/', [EmployerController::class, 'index'])->name('index');
        Route::get('/{id}', [EmployerController::class, 'show'])->name('show');
    });

    // job applications
    Route::prefix('job-applications')->name('job-applications.')->group(function () {
        Route::get('/{id}', [JobApplicationController::class, 'show'])->name('show');
        Route::post('/', [JobApplicationController::class, 'store'])->name('store');
    });

    // saved jobs
    Route::prefix('saved-jobs')->name('saved-jobs.')->group(function () {
        Route::get('/{id}', [SavedJobsController::class, 'show'])->name('show');
        Route::post('/', [SavedJobsController::class, 'store'])->name('store');
        Route::delete('/', [SavedJobsController::class, 'destroy'])->name('destroy');
    });

    // verify email
    Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
});
