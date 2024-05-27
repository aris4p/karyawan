<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::post('/simpan-karyawan', [KaryawanController::class,'simpan'])->name('simpan-karyawan');
Route::get('/getkaryawan/{id}', [KaryawanController::class,'getKaryawan'])->name('get-karyawan');
Route::post('/updatekaryawan/{id}', [KaryawanController::class,'update'])->name('get-karyawan');
