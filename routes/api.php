<?php

use App\Exports\FeedbackExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GptController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::middleware('admin.auth')->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout']);
    Route::post('/course/add', [CourseController::class, 'add']);
});


Route::post('/admin/register', [AdminController::class, 'register']);
Route::post('/admin/login', [AdminController::class, 'login']);

Route::get('/admin/course/catalog', [CourseController::class, 'catalog']);

Route::post('/mentor/login', [MentorController::class, 'login']);
Route::post('/mentor/logout', [MentorController::class, 'logout']);
Route::post('/mentor/create', [MentorController::class, 'create']);
Route::post('/mentor/update', [MentorController::class, 'update']);

Route::post('/student/login', [StudentController::class, 'login']);
Route::post('/student/register', [StudentController::class, 'register']);
Route::post('/student/logout', [StudentController::class, 'logout']);

Route::post('/refresh', [AdminController::class, 'refresh']);
Route::post('/getAdmin', [AdminController::class, 'getAdmin']);

Route::post('/course/update', [CourseController::class, 'update']);
Route::post('/course/delete', [CourseController::class, 'delete']);

Route::post('/feedback', [FeedbackController::class, 'feedback']);

Route::get('/export/feedback', function () {
    return Excel::download(new FeedbackExport, 'feedback.xlsx');
});


Route::post('/gpt', [GptController::class, 'gpt']);


// Защищённые роуты (только для авторизованных)
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});
