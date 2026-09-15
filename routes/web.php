<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LogAktivitasController;

// Autentikasi
Route::get('/', fn() => redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Protected
Route::middleware(['auth'])->group(function () {

    // 1. ADMIN
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        
        Route::resource('user', UserController::class)->except(['show']);
        Route::resource('tarif', TarifController::class)->except(['show']);
        Route::resource('area', AreaParkirController::class)->except(['show']);
        Route::resource('kendaraan', KendaraanController::class)->except(['show']);
        
        Route::get('/log', [LogAktivitasController::class, 'index'])->name('log.index');
    });

    // 2. PETUGAS
    Route::prefix('petugas')->name('petugas.')->middleware('role:petugas')->group(function () {
        Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');
        Route::resource('transaksi', TransaksiController::class)->only(['index']);
        Route::get('/parkir/masuk', [TransaksiController::class, 'masuk'])->name('parkir.masuk');
        Route::post('/parkir/masuk', [TransaksiController::class, 'storeMasuk'])->name('parkir.storeMasuk');
        Route::get('/parkir/keluar', [TransaksiController::class, 'keluar'])->name('parkir.keluar');
        
        // Menerima POST dan PUT agar tidak error MethodNotAllowed
        Route::match(['post', 'put'], '/parkir/keluar/{id}', [TransaksiController::class, 'storeKeluar'])->name('parkir.storeKeluar');
        
        Route::get('/struk/{id}', [TransaksiController::class, 'struk'])->name('struk.index');
    });

    // 3. OWNER
    Route::prefix('owner')->name('owner.')->middleware('role:owner')->group(function () {
        Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('dashboard');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    });

});