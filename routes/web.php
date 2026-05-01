<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LaporanController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [IzinController::class, 'landing'])->name('landing');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute Khusus Admin untuk Manajemen Pegawai
Route::middleware(['auth'])->group(function () {
    Route::resource('pegawai', PegawaiController::class);
    // Rute Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});

    // Group rute agar hanya yang login bisa akses
Route::middleware(['auth'])->group(function () {
    Route::get('/izin/baru', [IzinController::class, 'create'])->name('izin.create');
    Route::post('/izin', [IzinController::class, 'store'])->name('izin.store');
    Route::resource('pegawai', PegawaiController::class);
    // Rute Batalkan Izin (Hapus)
    Route::delete('/izin/{id}/batal', [IzinController::class, 'destroy'])->name('izin.destroy');
    // Rute untuk Atasan memproses izin
    Route::patch('/izin/{id}/setuju', [IzinController::class, 'setuju'])->name('izin.setuju');
    Route::patch('/izin/{id}/tolak', [IzinController::class, 'tolak'])->name('izin.tolak');
    Route::get('/izin/{id}/cetak', [IzinController::class, 'cetak'])->name('izin.cetak');
    Route::post('/izin/{id}/kembali', [IzinController::class, 'kembali'])->name('izin.kembali'); // Sekalian buat tombol 'Kembali'
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rute Ganti Password (Khusus)
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update'); // <-- TAMBAHKAN INI

    // Rute Khusus Admin untuk Manajemen Pegawai
    Route::resource('pegawai', PegawaiController::class);
});

Route::get('/cek-izin/{id}', [IzinController::class, 'scan'])->name('izin.scan');
require __DIR__.'/auth.php';
