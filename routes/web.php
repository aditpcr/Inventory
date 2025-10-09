<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\LoginController;


Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});





// Unified Login Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Role-specific Dashboard Routes
Route::get('/admin/dashboard', [LoginController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/supervisor/dashboard', [LoginController::class, 'supervisorDashboard'])->name('supervisor.dashboard');
Route::get('/employee/dashboard', [LoginController::class, 'employeeDashboard'])->name('employee.dashboard');

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});