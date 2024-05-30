<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\AdminUnivController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminFakultasController;

// Route::get('/', function () {
//     return view('landing-page.landing');
// })->name('landing');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/manage-admin-univ', [AdminUnivController::class, 'manageAdminUniv'])->name('admin.manage_admin_univ');
    Route::post('/add-admin-univ', [AdminUnivController::class, 'addAdminUniv'])->name('add.admin.univ');
    Route::post('/remove-admin-univ/{userId}', [AdminUnivController::class, 'removeAdminUniv'])->name('remove.admin.univ');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/manage-admin-fakultas', [AdminFakultasController::class, 'manageAdminFakultas'])->name('admin.manage_admin_fakultas');
    Route::post('/add-admin-fakultas', [AdminFakultasController::class, 'addAdminFakultas'])->name('add.admin.fakultas');
    Route::post('/remove-admin-fakultas/{userId}', [AdminFakultasController::class, 'removeAdminFakultas'])->name('remove.admin.fakultas');
});

Route::get('/admin/manage-user', [VoterController::class, 'index'])->name('admin.manage_user');
Route::post('/update-status', [VoterController::class, 'updateAccountStatus'])->name('admin.updateAccountStatus');

Route::get('/admin/manage-election', [ElectionController::class, 'index'])->name('admin.manage_election');
Route::post('/admin/manage-election',[ElectionController::class, 'create'])->name('admin.manage_create-election');
Route::delete('/admin/manage-election/{id}', [ElectionController::class, 'delete'])->name('admin.manage_delete-election');
