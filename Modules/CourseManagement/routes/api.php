<?php

use Illuminate\Support\Facades\Route;
use Modules\CourseManagement\Http\Controllers\CourseController;
use Modules\CourseManagement\Http\Controllers\TeacherController;
use Modules\CourseManagement\Http\Controllers\AssignmentController;
use Modules\CourseManagement\Http\Controllers\ExamController;
use Modules\CourseManagement\Http\Controllers\SubjectController;
use Modules\CourseManagement\Http\Controllers\QuestionController;
use Modules\CourseManagement\Http\Controllers\ExamSubmissionController;






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



// Courses routes
Route::prefix('courses')->middleware('admin')->group(function () {
    Route::get('/', [CourseController::class, 'index']);
    Route::post('/store', [CourseController::class, 'store']);
    Route::get('/{id}', [CourseController::class, 'show']);
    Route::put('/{id}', [CourseController::class, 'update']);
    Route::delete('/{id}', [CourseController::class, 'destroy']);
});



// Teachers routes
Route::prefix('teachers')->group(function () {
    Route::get('/index', [TeacherController::class, 'index']);
    Route::post('/store', [TeacherController::class, 'store']);
    Route::get('/show/{id}', [TeacherController::class, 'show']);
    Route::put('/update/{id}', [TeacherController::class, 'update']);
    Route::delete('/destroy/{id}', [TeacherController::class, 'destroy']);
});




// Subjects routes
Route::prefix('subjects')->group(function () {
    Route::get('/', [SubjectController::class, 'index']);
    Route::post('/', [SubjectController::class, 'store']);
    Route::get('/{id}', [SubjectController::class, 'show']);
    Route::put('/{id}', [SubjectController::class, 'update']);
    Route::delete('/{id}', [SubjectController::class, 'destroy']);
});




// Assignments routes
Route::prefix('assignments')->group(function () {
    Route::get('/', [AssignmentController::class, 'index']);
    Route::post('/', [AssignmentController::class, 'store']);
    Route::get('/{id}', [AssignmentController::class, 'show']);
    Route::put('/{id}', [AssignmentController::class, 'update']);
    Route::delete('/{id}', [AssignmentController::class, 'destroy']);
});




// Exam routes
Route::prefix('exams')->middleware('admin')->group(function () {
    Route::post('/', [ExamController::class, 'store']);
    Route::put('/{id}', [ExamController::class, 'update']);
    Route::delete('/{id}', [ExamController::class, 'destroy']);
});

Route::prefix('exams')->group(function () {
    Route::get('/', [ExamController::class, 'index']);
    Route::get('/{id}', [ExamController::class, 'show']);
});




// Question routes
Route::middleware(['auth:api', 'admin'])->prefix('questions')->group(function () {
    Route::get('/', [QuestionController::class, 'index']);
    Route::post('/', [QuestionController::class, 'store']);
    Route::get('/{id}', [QuestionController::class, 'show']);
    Route::put('/{id}', [QuestionController::class, 'update']);
    Route::delete('/{id}', [QuestionController::class, 'destroy']);
});






// Exam Submission routes
Route::prefix('exam-submissions')->group(function () {

    Route::middleware('auth:api')->group(function () {
        Route::post('/submit/{exam_id}', [ExamSubmissionController::class, 'submit']);
        Route::get('/{id}', [ExamSubmissionController::class, 'show']);
    });

    Route::middleware(['auth:api', 'admin'])->group(function () {
        Route::post('/', [ExamSubmissionController::class, 'store']);
        Route::put('/{id}', [ExamSubmissionController::class, 'update']);
        Route::delete('/{id}', [ExamSubmissionController::class, 'destroy']);
    });
});



