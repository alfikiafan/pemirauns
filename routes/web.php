<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PemiraController;
use App\Http\Controllers\CandidateInfoController;

Route::get('/', function () {
    return view('landing');
})->name('landing');
// Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::get('/candidate/dashboard', [AuthController::class, 'dashboard'])->name('candidate.dashboard')->middleware('auth');
Route::get('/user/dashboard', [AuthController::class, 'dashboard'])->name('user.dashboard')->middleware('auth');

Route::get('/pemira', [UserController::class, 'showPemira'])->name('pemira.index');
Route::get('/pemira/{pemira_id}/candidates', [UserController::class, 'showCandidates'])->name('candidates.index');
Route::get('/candidates/{id}', [UserController::class, 'showCandidateProfile'])->name('candidates.profile');
Route::post('/vote', [UserController::class, 'vote'])->name('vote')->middleware('auth');

Route::resource('reports', ReportController::class);
Route::resource('informations', InformationController::class);
Route::resource('pemira', PemiraController::class);

Route::get('/candidates/{id}', [CandidateInfoController::class, 'show'])->name('candidates.info');
Route::post('/candidates/{id}/update', [CandidateInfoController::class, 'update'])->name('candidates.update');
Route::post('/candidates/{id}/achievements', [CandidateInfoController::class, 'storeAchievement'])->name('achievements.store');
Route::put('/achievements/{achievement_id}', [CandidateInfoController::class, 'updateAchievement'])->name('achievements.update');
Route::delete('/achievements/{achievement_id}', [CandidateInfoController::class, 'destroyAchievement'])->name('achievements.destroy');
Route::post('/candidates/{id}/experiences', [CandidateInfoController::class, 'storeExperience'])->name('experiences.store');
Route::put('/experiences/{experience_id}', [CandidateInfoController::class, 'updateExperience'])->name('experiences.update');
Route::delete('/experiences/{experience_id}', [CandidateInfoController::class, 'destroyExperience'])->name('experiences.destroy');
