<?php

use Illuminate\Support\Facades\Route;
use Modules\StudentManagement\Http\Controllers\AttendanceController;
use Modules\StudentManagement\Http\Controllers\EnrollmentController;
use Modules\StudentManagement\Http\Controllers\EvaluationController;
use Modules\StudentManagement\Http\Controllers\StudentController;





/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

// Students routes
Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index']);
        Route::post('/store', [StudentController::class, 'store']);
        Route::get('/{id}', [StudentController::class, 'show']);
        Route::put('/{id}', [StudentController::class, 'update']);
        Route::delete('/{id}', [StudentController::class, 'destroy']);
    });


    // Enrollments routes
    Route::prefix('enrollments')->group(function () {
        Route::get('/', [EnrollmentController::class, 'index']);
        Route::post('/store', [EnrollmentController::class, 'store']);
        Route::get('/{id}', [EnrollmentController::class, 'show']);
        Route::put('/{id}', [EnrollmentController::class, 'update']);
        Route::delete('/{id}', [EnrollmentController::class, 'destroy']);
    });

    // Attendance routes
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index']);
        Route::post('/store', [AttendanceController::class, 'store']);
        Route::get('/{id}', [AttendanceController::class, 'show']);
        Route::put('/{id}', [AttendanceController::class, 'update']);
        Route::delete('/{id}', [AttendanceController::class, 'destroy']);
    });


    // Evaluations routes
    Route::prefix('evaluations')->group(function () {
        Route::get('/', [EvaluationController::class, 'index']);
        Route::post('/store', [EvaluationController::class, 'store']);
        Route::get('/{id}', [EvaluationController::class, 'show']);
        Route::put('/{id}', [EvaluationController::class, 'update']);
        Route::delete('/{id}', [EvaluationController::class, 'destroy']);
    });
});


