<?php

use App\Http\Controllers\AttendaceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'login' => false,
    'register' => false,
]);

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::post('/', [LoginController::class, 'login'])->name('login');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/presensi', [AttendaceController::class, 'index']);
Route::post('presensi/store', [AttendaceController::class, 'store']);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
