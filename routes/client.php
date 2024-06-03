<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubmmissionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:student'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login.index');
    Route::post('auth/login', [AuthController::class, 'store'])->name('login.store');
});

Route::middleware(['auth:student'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Scan QR
    Route::get('scan', [QrCodeController::class, 'scan'])->name('qrcode.scan');
    Route::post('scan/validate', [QrCodeController::class, 'validation'])->name('qrcode.validation');

    // Presensi
    Route::get('presensi/{uuid}', [PresensiController::class, 'index'])->name('presensi.index');
    Route::post('presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('presensi/history', [PresensiController::class, 'history'])->name('presensi.history');
    Route::post('presensi/history', [PresensiController::class, 'getHistory']);

    // Student
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('', [StudentController::class, 'index'])->name('index');
        Route::put('{nik}', [StudentController::class, 'update'])->name('update');
    });

    // Submission
    Route::prefix('submission')->name('submission.')->group(function () {
        Route::get('', [SubmmissionController::class, 'index'])->name('index');
        Route::get('/leave', [SubmmissionController::class, 'create'])->name('create');
        Route::post('/leave', [SubmmissionController::class, 'store'])->name('store');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
