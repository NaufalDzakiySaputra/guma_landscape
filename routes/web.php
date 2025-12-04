<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminReservasiController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\AdminVillaController;
use Illuminate\Support\Facades\Route;

// ===== PUBLIC ROUTES (PENGUNJUNG) =====
Route::get('/', function () {
    return view('home');
})->name('home');

// ===== ADMIN ROUTES =====
Route::prefix('admin')->group(function () {
    // Auth Routes - HARUS DI LUAR MIDDLEWARE
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes - PAKAI MIDDLEWARE
    Route::middleware(['admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Reservasi Management
        Route::get('/reservasi', [AdminReservasiController::class, 'index'])->name('admin.reservasi.index');
        Route::get('/reservasi/{id}', [AdminReservasiController::class, 'show'])->name('admin.reservasi.show');
        Route::put('/reservasi/{id}/status', [AdminReservasiController::class, 'updateStatus'])->name('admin.reservasi.updateStatus');
        
        // Pembayaran Management
        Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('admin.pembayaran.index');
        Route::put('/pembayaran/{id}/status', [AdminPembayaranController::class, 'updateStatus'])->name('admin.pembayaran.updateStatus');
        
        // Villa Management
        Route::get('/villa', [AdminVillaController::class, 'index'])->name('admin.villa.index');
        Route::post('/villa', [AdminVillaController::class, 'store'])->name('admin.villa.store');
        Route::put('/villa/{id}', [AdminVillaController::class, 'update'])->name('admin.villa.update');
        Route::delete('/villa/{id}', [AdminVillaController::class, 'destroy'])->name('admin.villa.destroy');
    });
});