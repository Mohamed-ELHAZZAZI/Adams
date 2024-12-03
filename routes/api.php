<?php

use App\Http\Controllers\AcademicLevelsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassSessionController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\MajorsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware(['auth:sanctum', 'teacher'])->group(function () {
    Route::get('/teacher/data', [TeachersController::class, 'getData']);
    Route::post('teacher/logout', [TeachersController::class, 'logout']);
    Route::get('teacher/get-classes', [TeachersController::class, 'getClasses']);

    Route::get('teacher/get-class/{id}', [CoursesController::class, 'getClassInfo']);

    Route::post('class-session/create', [ClassSessionController::class, 'create']);
    Route::get('class-session/get/{course_id}', [ClassSessionController::class, 'get']);

    ROute::get('attendance/get/{class_id}', [AttendanceController::class, 'get']);
    ROute::post('attendance/update', [AttendanceController::class, 'changeStatus']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/admin/data', [AdminsController::class, 'getData']);
    Route::post('admin/logout', [AdminsController::class, 'logout']);

    Route::post('students/create', [StudentsController::class, 'create']);
    Route::get('students/get', [StudentsController::class, 'get']);
    // Route::get('students/get-attendance/{{id}}', [Attendance::class . 'getAttendanceCounts']);
    Route::post('teaches/create', [TeachersController::class, 'create']);
    Route::get('teachers/get', [TeachersController::class, 'get']);

    Route::post('courses/create', [CoursesController::class, 'create']);
    Route::get('courses/get', [CoursesController::class, 'get']);

    Route::get('majors/get', [MajorsController::class, 'getAll']);
    Route::get('countries/get', [CountriesController::class, 'getAll']);
    Route::get('levels/get', [AcademicLevelsController::class, 'getAll']);
});



Route::post("teachers/auth/login", [TeachersController::class, 'login']);

Route::post('admins/auth/login', [AdminsController::class, 'login']);
