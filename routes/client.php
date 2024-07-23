<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubmmissionController;
use App\Http\Controllers\WelcomeController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;

// LandingPage
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('get-scheules', [WelcomeController::class, 'getSchedules'])->name('getSchedules');
Route::get('get-absensi', [WelcomeController::class, 'getAbsensi'])->name('getAbsensi');

Route::middleware(['guest:student'])->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        // Login
        Route::prefix('login')->name('login.')->group(function () {
            Route::get('', [AuthController::class, 'index'])->name('index');
            Route::post('', [AuthController::class, 'store'])->name('store');
        });

        // Register
        Route::prefix('register')->name('register.')->group(function () {
            Route::get('', [AuthController::class, 'register'])->name('index');
            Route::post('', [AuthController::class, 'registerStore'])->name('store');
        });
    });
});

Route::middleware(['auth:student'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Scan QR
    Route::get('scan', [QrCodeController::class, 'scan'])->name('qrcode.scan');
    Route::post('scan/validate', [QrCodeController::class, 'validation'])->name('qrcode.validation');

    // Presensi
    Route::post('presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::get('presensi/{uuid}/detail', [PresensiController::class, 'index'])->name('presensi.index');
    Route::get('presensi/history', [PresensiController::class, 'history'])->name('presensi.history');

    // Student
    Route::prefix('student')->name('student.')->group(function () {
    });

    // Submission
    Route::prefix('submission')->name('submission.')->group(function () {
        Route::get('', [SubmmissionController::class, 'index'])->name('index');
        Route::get('leave', [SubmmissionController::class, 'create'])->name('create');
        Route::post('leave', [SubmmissionController::class, 'store'])->name('store');
    });

    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('index');

        Route::prefix('profile')->name('profile.')->group(function () {

            // Change Password
            Route::get('change-password', [StudentController::class, 'changePassword'])->name('change-password');
            Route::put('change-password', [StudentController::class, 'updatePassword'])->name('update-password');

            // Change Picture
            Route::get('change-picture', [StudentController::class, 'changePicture'])->name('change-picture');
            Route::put('change-picture', [StudentController::class, 'updatePicture'])->name('update-picture');

            // Update Information Profile
            Route::get('information', [StudentController::class, 'index'])->name('information');
            Route::put('{nik}', [StudentController::class, 'update'])->name('update');
        });
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
