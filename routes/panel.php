<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\AdminClassroomController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminPresensiController;
use App\Http\Controllers\admin\AdminReportController;
use App\Http\Controllers\admin\AdminScheduleController;
use App\Http\Controllers\admin\AdminSettingController;
use App\Http\Controllers\admin\AdminStudentController;
use App\Http\Controllers\admin\AdminSubjectController;
use App\Http\Controllers\admin\AdminSubmissionController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:user'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.auth.login');
    })->name('admin.login.index');
    Route::post('admin/auth/login', [AdminAuthController::class, 'store'])->name('admin.login.store');
});

Route::middleware(['auth:user'])->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {
        // Schedules
        Route::prefix('schedules')->name('schedules.')->group(function () {
            Route::get('', [ScheduleController::class, 'index'])->name('index');
            Route::get('get-class', [ScheduleController::class, 'getClass'])->name('getClass');
            Route::get('get-scheules', [ScheduleController::class, 'getSchedules'])->name('getSchedules');
        });

        // Generate QR
        Route::get('scan', [QrCodeController::class, 'qrcode'])->name('qr.qrcode');
        Route::get('generate', [QrCodeController::class, 'generateQr'])->name('qr.generate');

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Presensi
        Route::resource('presensi', AdminPresensiController::class);

        // Report
        Route::prefix('report')->name('report.')->group(function () {
            // Report Absensi
            Route::get('absensi', [AdminReportController::class, 'presensi'])->name('presensi');
            Route::post('absensi', [AdminReportController::class, 'absensiPrint'])->name('absensi.print');

            // Rekap Absensi
            Route::get('rekap', [AdminReportController::class, 'rekap'])->name('rekap');
            Route::post('rekap', [AdminReportController::class, 'rekapPrint'])->name('rekapPrint');
        });

        // Data Master
        Route::prefix('master')->group(function () {

            // Master User
            Route::prefix('users')->name('users.')->group(function () {
                Route::get('list', [UserController::class, 'list'])->name('list');

                Route::get('', [UserController::class, 'index'])->name('index');
                Route::get('create', [UserController::class, 'create'])->name('create');
                Route::post('create', [UserController::class, 'store'])->name('store');
                Route::post('status', [UserController::class, 'status'])->name('status');
                Route::get('{nik}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('{nik}/edit', [UserController::class, 'update'])->name('update');
                Route::delete('{nik}', [UserController::class, 'destroy'])->name('destroy');
            });

            // Master Student
            Route::prefix('student')->name('student.')->group(function () {
                Route::get('list', [AdminStudentController::class, 'list'])->name('list');

                Route::get('', [AdminStudentController::class, 'index'])->name('index');
                Route::post('', [AdminStudentController::class, 'store'])->name('store');
                Route::get('create', [AdminStudentController::class, 'create'])->name('create');
                Route::post('status', [AdminStudentController::class, 'status'])->name('status');
                Route::get('{student}', [AdminStudentController::class, 'show'])->name('show');
                Route::get('{student}/edit', [AdminStudentController::class, 'edit'])->name('edit');
                Route::put('{student}/edit', [AdminStudentController::class, 'update'])->name('update');
                Route::delete('{student}', [AdminStudentController::class, 'destroy'])->name('destroy');
            });

            // Master Classroom
            Route::prefix('classroom')->name('classroom.')->group(function () {
                Route::get('list', [AdminClassroomController::class, 'list'])->name('list');

                Route::get('', [AdminClassroomController::class, 'index'])->name('index');
                Route::post('', [AdminClassroomController::class, 'store'])->name('store');
                Route::get('create', [AdminClassroomController::class, 'create'])->name('create');
                Route::get('{classroom}', [AdminClassroomController::class, 'show'])->name('show');
                Route::get('{classroom}/edit', [AdminClassroomController::class, 'edit'])->name('edit');
                Route::put('{classroom}/edit', [AdminClassroomController::class, 'update'])->name('update');
                Route::delete('{classroom}', [AdminClassroomController::class, 'destroy'])->name('destroy');
            });

            // Submissions
            Route::prefix('submission')->name('submission.')->group(function () {
                Route::get('', [AdminSubmissionController::class, 'index'])->name('index');
                Route::get('{submmission}', [AdminSubmissionController::class, 'edit'])->name('edit');
                Route::put('{submmission}', [AdminSubmissionController::class, 'update'])->name('update');
            });

            // Presensi
            Route::prefix('presensi')->name('presensi.master.')->group(function () {
                Route::get('', [AdminPresensiController::class, 'index'])->name('index');
            });
        });

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            // Location
            Route::get('location', [AdminSettingController::class, 'location'])->name('location');
            Route::put('location', [AdminSettingController::class, 'location']);

            // absence time
            Route::get('absence-time', [AdminSettingController::class, 'absenceTime'])->name('absenceTime');
            Route::put('absence-time', [AdminSettingController::class, 'absenceTime']);

            // Subject
            Route::prefix('subjects')->name('subjects.')->group(function () {
                Route::get('', [AdminSubjectController::class, 'index'])->name('index');
                Route::post('', [AdminSubjectController::class, 'store'])->name('store');
                Route::get('{id}/edit', [AdminSubjectController::class, 'edit'])->name('edit');
                Route::put('{id}/edit', [AdminSubjectController::class, 'update'])->name('update');
                Route::delete('{id}', [AdminSubjectController::class, 'destroy'])->name('destroy');
            });

            // Schedules
            Route::prefix('schedules')->name('schedules.')->group(function () {
                Route::get('', [AdminScheduleController::class, 'index'])->name('index');
                Route::post('', [AdminScheduleController::class, 'store'])->name('store');
                Route::get('get-schedules', [AdminScheduleController::class, 'list'])->name('list');
                Route::get('get-subjects', [AdminScheduleController::class, 'subjects'])->name('subjects');
                Route::get('get-users', [AdminScheduleController::class, 'users'])->name('users');
                Route::get('{id}/edit', [AdminScheduleController::class, 'edit'])->name('edit');
                Route::put('{id}/edit', [AdminScheduleController::class, 'update'])->name('update');
                Route::delete('{id}', [AdminScheduleController::class, 'destroy'])->name('destroy');
            });
        });

        Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});
