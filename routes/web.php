<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WNAController;
use App\Http\Controllers\WNAImportController;
use Illuminate\Support\Facades\Route;


// ================= DEFAULT =================
Route::get('/', fn() => redirect('/login'));


// ================= LOGIN =================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// ================= LOGOUT =================
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// ================= DASHBOARD REDIRECT =================
Route::get('/dashboard', function () {
    return auth()->user()->role == 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('user.dashboard');
})->middleware(['auth', 'check.status']);


// =====================================================
// ================= GLOBAL AUTH ========================
// =====================================================
Route::middleware(['auth', 'check.status'])->group(function () {

    // PROFILE
    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');


    // =====================================================
    // ================= WNA (SEMUA DI SINI) =================
    // =====================================================
    Route::prefix('wna')->name('wna.')->group(function () {

        // ===== READ =====
        Route::get('/', [WNAController::class, 'index'])->name('index');

        Route::get('/wilayah/{wilayah}', [WNAController::class, 'wilayah'])
            ->name('wilayah');

        Route::get('/wilayah/{wilayah}/jenis/{jenis}', [WNAController::class, 'byJenis'])
            ->name('byJenis');

        Route::get('/wilayah/{wilayah}/all', [WNAController::class, 'byWilayah'])
            ->name('byWilayah');

        Route::get('/kabupaten/{wilayah}/{jenis?}', [WNAController::class, 'kabupaten'])
            ->name('kabupaten');

        // ===== ADMIN ONLY =====
        Route::middleware('role:admin')->group(function () {

            // CRUD
            Route::get('/create', [WNAController::class, 'create'])->name('create');
            Route::post('/store', [WNAController::class, 'store'])->name('store');

            Route::get('/edit/{nomor_paspor}', [WNAController::class, 'edit'])->name('edit');
            Route::put('/update/{nomor_paspor}', [WNAController::class, 'update'])->name('update');

            Route::delete('/delete/{nomor_paspor}', [WNAController::class, 'destroy'])
                ->name('destroy');

            // ✅ IMPORT EXCEL (FIX ERROR DI SINI)
            Route::post('/import', [WNAImportController::class, 'upload'])
                ->name('import');
        });


        // 🚨 HARUS PALING BAWAH (ANTI TABRAKAN DENGAN ROUTE LAIN)
        Route::get('/{nomor_paspor}', [WNAController::class, 'show'])
            ->where('nomor_paspor', '[A-Za-z0-9]+')
            ->name('show');
    });
});


// =====================================================
// ================= ADMIN ==============================
// =====================================================
Route::middleware(['auth', 'check.status', 'role:admin'])->group(function () {

    // DASHBOARD
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // USER MANAGEMENT
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
});


// =====================================================
// ================= STAFF ==============================
// =====================================================
Route::middleware(['auth', 'check.status', 'role:staff'])->group(function () {

    Route::get('/user/dashboard', [DashboardController::class, 'index'])
        ->name('user.dashboard');
});


// =====================================================
// ================= GLOBAL FEATURE =====================
// =====================================================

// NOTIFICATION
Route::get('/notif/{id}', [NotificationController::class, 'read'])->name('notif.read');
Route::get('/notif/read/{id}', [NotificationController::class, 'read']);

// LAPORAN
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('admin.laporan.pdf');