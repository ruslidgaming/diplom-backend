<?php

use App\Exports\FeedbackExport;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CerteficatController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GptController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MenourseController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/admin/logout', [AdminController::class, 'logout']);
Route::get('/admin/course/show', [CourseController::class, 'show']);

Route::middleware('admin.auth')->group(function () {
    Route::get('/admin/course/catalog', [CourseController::class, 'catalog']);
    Route::get('/admin/course/teacher/delete', [TeacherController::class, 'delete']);

    Route::post('/course/add', [CourseController::class, 'add']);
    Route::post('/course/update', [CourseController::class, 'update']);
    Route::get('/course/delete', [CourseController::class, 'delete']);

    Route::post('/mentor/create', [MentorController::class, 'create']);
    Route::post('/mentor/update', [MentorController::class, 'update']);
    Route::get('/mentor/catalog', [MentorController::class, 'catalog']);
    Route::get('/mentor/delete', [MentorController::class, 'delete']);

    Route::get('/mentor/edit', [MentorController::class, 'edit']);
    Route::post('/mentor/course/delete', [MenourseController::class, 'delete']);
    Route::post('/mentor/course/add', [MenourseController::class, 'add']);
});

Route::get('/mentor/course', [MentorController::class, 'course']);


Route::post('/assets/upload', [AssetController::class, 'upload']);
Route::delete('/assets/delete', [AssetController::class, 'delete']);
Route::get('/assets', [AssetController::class, 'index']);
Route::get('/mentor/course', [MentorController::class, 'course']);


Route::get('/cerf', [CerteficatController::class, 'cerf']);

Route::get('/projects/load/{id}', [ProjectController::class, 'load']);
Route::post('/projects/store/{id}', [ProjectController::class, 'store']);


Route::post('/admin/register', [AdminController::class, 'register']);
Route::post('/admin/login', [AdminController::class, 'login']);

Route::post('/mentor/login', [MentorController::class, 'login']);
Route::post('/mentor/logout', [MentorController::class, 'logout']);

Route::post('/student/login', [StudentController::class, 'login']);
Route::post('/student/register', [StudentController::class, 'register']);
Route::post('/student/logout', [StudentController::class, 'logout']);

Route::post('/student/pay', [StudentController::class, 'pay']);
Route::get('/student/lessons/list', [StudentController::class, 'lessonsList']);
Route::post('/student/finish', [StudentController::class, 'finish']);
Route::get('/student/all', [StudentController::class, 'all']);
Route::get('/student/my', [StudentController::class, 'my']);
Route::get('/student/end', [StudentController::class, 'end']);

Route::post('/refresh', [AdminController::class, 'refresh']);
Route::post('/getAdmin', [AdminController::class, 'getAdmin']);


Route::post('/feedback', [FeedbackController::class, 'feedback']);
Route::get('/feedback/delete', [FeedbackController::class, 'delete']);

Route::get('/export/feedback', function () {
    return Excel::download(new FeedbackExport, 'feedback.xlsx');
});


Route::post('/gpt', [GptController::class, 'gpt']);


Route::post('/upload-image', function (Request $request) {

    if (!$request->hasFile('image')) {
        return response()->json(['error' => 'No image uploaded'], 400);
    }
    $image = $request->file('image')->store('Editor', 'public');
    $image = "http://127.0.0.1:8000/storage/" . $image;
    return response()->json(['link' => $image]);
});

Route::post('/upload-image/designer', function (Request $request) {

    if (!$request->hasFile('image')) {
        return response()->json(['error' => 'No image uploaded'], 400);
    }

    $image = $request->file('image')->store('Designer', 'public');
    return response()->json(['link' => $image]);
});



Route::get('/images/upload/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    return response()->file($path);
});

Route::post('/upload-video', function (Request $request) {

    if (!$request->hasFile('video')) {
        return response()->json(['error' => 'No image uploaded'], 400);
    }

    $videoPath = $request->file('video')->store('video', 'public');


    $videoPath = "http://127.0.0.1:8000/storage/" . $videoPath;
    return response()->json(['link' => $videoPath]);
});
// Защищённые роуты (только для авторизованных)
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});


Route::post('/lessons/create', [LessonController::class, 'add']);
Route::get('/lessons/catalog', [LessonController::class, 'catalog']);
Route::get('/lessons/delete', [LessonController::class, 'delete']);
Route::get('/lessons/show', [LessonController::class, 'show']);
Route::post('/lessons/edit', [LessonController::class, 'edit']);
Route::get('/lessons/serteficate', [LessonController::class, 'serteficate']);

Route::post('/projects', function () {
    return response()->json("no");
});
Route::put('/projects', [LessonController::class, 'texting']);


// РОУТЕРЫ СПИСКОВ
Route::get('/list/admin', [ListController::class, 'admin']);
Route::get('/list/feedback', [ListController::class, 'feedback']);


Route::post('/tariff/pay', [AdminController::class, 'tariff']);


Route::get('/statistic/admin', [StatisticController::class, 'admin']);
Route::get('/statistic/super', [StatisticController::class, 'super']);
