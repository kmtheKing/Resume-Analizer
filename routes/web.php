<?php

use App\Http\Controllers\ResumeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/resumes', [ResumeController::class, 'index'])->name('resumes.index');
Route::get('/resumes/upload', [ResumeController::class, 'upload'])->name('resumes.upload');
Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
Route::get('/resumes/{resume}', [ResumeController::class, 'show'])->name('resumes.show');

// Job Routes
Route::resource('jobs', JobController::class)->only(['index', 'create', 'store']);
Route::get('/resumes/{resume}/match', [JobController::class, 'match'])->name('jobs.match');
Route::post('/resumes/{resume}/analyze', [JobController::class, 'analyze'])->name('jobs.analyze');

// Analysis Routes
Route::get('/analysis/{analysis}', [AnalysisController::class, 'show'])->name('analysis.show');
