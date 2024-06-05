<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\AdminUnivController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminFacultyController;
use App\Http\Controllers\CandidateController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/admin/manage-user', [VoterController::class, 'index'])->name('admin.users.index');
Route::post('/update-status', [VoterController::class, 'updateAccountStatus'])->name('admin.updateAccountStatus');

Route::get('/admin/manage-election', [ElectionController::class, 'index'])->name('admin.manage_election');
Route::post('/admin/manage-election',[ElectionController::class, 'create'])->name('admin.manage_create-election');
Route::delete('/admin/manage-election/{id}', [ElectionController::class, 'delete'])->name('admin.manage_delete-election');

Route::get('/admin/candidate', [CandidateController::class, 'index'])->name('admin.candidates.index');
Route::get('/admin/candidate/create', [CandidateController::class, 'create'])->name('admin.candidates.create');
Route::post('/admin/candidate', [CandidateController::class, 'store'])->name('admin.candidates.store');
Route::get('/admin/candidate/{id}/edit', [CandidateController::class, 'edit'])->name('admin.candidates.edit');
Route::put('/admin/candidate/{candidate}', [CandidateController::class, 'update'])->name('admin.candidates.update');
Route::delete('/admin/candidate/{candidate}', [CandidateController::class, 'destroy'])->name('admin.candidates.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/admin/manage_admin_fakultas', [AdminFacultyController::class, 'index'])->name('admin.admin_faculty.index');
    Route::get('/admin/manage_admin_fakultas/create', [AdminFacultyController::class, 'create'])->name('admin.admin_faculty.create');
    Route::post('/admin/manage_admin_fakultas/store', [AdminFacultyController::class, 'store'])->name('admin.admin_faculty.store');
    Route::post('/admin/manage_admin_fakultas/remove/{userId}', [AdminFacultyController::class, 'removeAdminFakultas'])->name('admin.admin_faculty.remove');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/manage_admin_univ', [AdminUnivController::class, 'index'])->name('admin.admin_univ.index');
    Route::get('/admin/manage_admin_univ/create', [AdminUnivController::class, 'create'])->name('admin.admin_univ.create');
    Route::post('/admin/manage_admin_univ/store', [AdminUnivController::class, 'store'])->name('admin.admin_univ.store');
    Route::post('/admin/manage_admin_univ/remove/{userId}', [AdminUnivController::class, 'removeAdminUniv'])->name('admin.admin_univ.remove');
});