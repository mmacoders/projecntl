<?php

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\EmployeeAdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PresenceAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\History\HistoryController;
use App\Http\Controllers\Pengajuan\PengajuanIzinController;
use App\Http\Controllers\Presence\PresenceController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::controller(LoginController::class)->group(function() {
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
});

Route::middleware(['auth:employee'])->group(function() {

    Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'home']);

    // Route::post('/logout', [LoginController::class, 'logout']);

    // Admin
    Route::middleware(['authRole:admin'])->group(function() {
        Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard-admin');

        Route::get('/admin/employees', [EmployeeAdminController::class, 'index'])->name('employee-admin');

        Route::post('/admin/employee/store', [EmployeeAdminController::class, 'store'])->name('employee.store');
        Route::post('/admin/employee/edit', [EmployeeAdminController::class, 'edit'])->name('employee.edit');
        Route::put('/admin/employee/{id_employee}/update', [EmployeeController::class, 'update']);

        Route::get('/admin/monitoring/presence', [PresenceAdminController::class, 'index'])->name('presence-admin');
        Route::post('/admin/presences', [PresenceAdminController::class, 'getPresence'])->name('presence-admin.create');
    });

    // User
    Route::middleware(['authRole:user'])->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/presence/create', [PresenceController::class, 'create'])->name('presence.create');
    Route::post('/presence/store', [PresenceController::class, 'store'])->name('presence.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile/{id_employee}', [ProfileController::class, 'update']);

    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::post('/history', [HistoryController::class, 'search']);

    Route::get('/pengajuan-izin', [PengajuanIzinController::class, 'index'])->name('pengajuan-izin');
    Route::get('/pengajuan-izin/create', [PengajuanIzinController::class, 'create'])->name('pengajuan-izin.create');
    Route::post('/pengajuan-izin/store', [PengajuanIzinController::class, 'store'])->name('pengajuan-izin.store');
    });

});

// Route::group(['middleware' => 'authRole:user'], function() {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//     Route::controller(PresenceController::class)->group(function() {
//         Route::get('/presence/create', 'create')->name('presence.create');
//         Route::post('/presence/store', 'store')->name('presence.store');
//     });
// });


// Route::group(['middleware' => 'authRole:admin'], function() {
//     Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
//     Route::get('/admin/employees', [EmployeeController::class, 'index'])->name('employee-admin');
//     });
// Route::group(['middleware' => 'auth'], function() {

//     // User
//     Route::group(['middleware' => 'authRole:user'], function(){
        
//         // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//         Route::get('/presence', [AttendanceController::class, 'create'])->name('presensi.create');
//         Route::post('presensi/store', [AttendanceController::class, 'store'])->name('presensi.store');
//         Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
//         Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
//         Route::put('/profile/2', [ProfileController::class, 'edit']);


//         // Pengajuan izin
//         Route::get('/presensi/pengajuan-izin', [IzinController::class, 'index'])->name('pengajuan-izin');
//         Route::get('presensi/pengajuan-izin/create', [IzinController::class, 'create'])->name('pengajuan-izin.create');
//         Route::post('presensi/pengajuan-izin/store', [IzinController::class, 'store'])->name('pengajuan-izin.store');
//     });


//     
// });