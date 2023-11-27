<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\History\HistoryController;
use App\Http\Controllers\Pengajuan\IzinController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes([
    'register' => false,
]);

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/presensi', [AttendanceController::class, 'create'])->name('presensi.create');
Route::post('presensi/store', [AttendanceController::class, 'store'])->name('presensi.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/2', [ProfileController::class, 'edit']);

// History
Route::get('/history', [HistoryController::class, 'index'])->name('history');
Route::post('/history', [HistoryController::class, 'search']);

// Pengajuan izin
Route::get('/presensi/pengajuan-izin', [IzinController::class, 'index'])->name('pengajuan-izin');
Route::get('presensi/pengajuan-izin/create', [IzinController::class, 'create'])->name('pengajuan-izin.create');
Route::post('presensi/pengajuan-izin/store', [IzinController::class, 'store'])->name('pengajuan-izin.store');

Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard-admin');


// Route::middleware(['role:user'])->group(function() {
   
// });


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
