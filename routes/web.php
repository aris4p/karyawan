<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
Route::get('/', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/auth-login', [LoginController::class, 'authenticate'])->name('proses-login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
});
Route::middleware(['auth', 'auth.session'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::post('/simpan-karyawan', [KaryawanController::class,'simpan'])->name('simpan-karyawan');
Route::get('/getkaryawan/{id}', [KaryawanController::class,'getKaryawan'])->name('get-karyawan');
Route::post('/updatekaryawan/{id}', [KaryawanController::class,'update'])->name('get-karyawan');
Route::delete('/deletekaryawan/{id}', [KaryawanController::class, 'delete']);
Route::get('/gantipassword', [KaryawanController::class, 'gantipassword'])->name('changepassword');
Route::post('/prosesgantipassword', [KaryawanController::class, 'prosesgantiPassword'])->name('change-password');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});