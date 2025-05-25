<?php

use App\Exports\FeedbackExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GptController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Framework\Attributes\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view("main.welcome");
});

Route::get('/login', [AdminController::class, 'loginWeb'])->name('login');
Route::get('/register', [AdminController::class, 'registerWeb'])->name('register');
Route::post('/register', [AdminController::class, 'register']);
Route::post('/login', [AdminController::class, 'login']);

Route::middleware('admin.auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'logout']);

    Route::post('/course/add', [CourseController::class, 'add']);
    Route::get('/course/delete', [CourseController::class, 'delete']);
    Route::post('/course/update', [CourseController::class, 'update']);

    Route::get('/admin/course/catalog', [CourseController::class, 'catalog']);
    Route::get('/admin/course/show', [CourseController::class, 'show']);

    Route::get('/admin/course/teacher/delete', [TeacherController::class, 'delete']);

    Route::get('/mentor/catalog', [MentorController::class, 'catalog']);
    Route::post('/mentor/create', [MentorController::class, 'create']);
    Route::post('/mentor/update', [MentorController::class, 'update']);
});

Route::post('/mentor/login', [MentorController::class, 'login']);
Route::post('/mentor/logout', [MentorController::class, 'logout']);

Route::post('/student/login', [StudentController::class, 'login']);
Route::post('/student/register', [StudentController::class, 'register']);
Route::post('/student/logout', [StudentController::class, 'logout']);

Route::post('/refresh', [AdminController::class, 'refresh']);
Route::post('/getAdmin', [AdminController::class, 'getAdmin']);


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


Route::get('/images/upload/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    return response()->file($path);
});
