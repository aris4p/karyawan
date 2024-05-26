<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
