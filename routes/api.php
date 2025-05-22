<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AdminController::class, 'register']);
Route::post('/login', [AdminController::class, 'login']);
Route::post('/refresh', [AdminController::class, 'refresh']);
Route::post('/getAdmin', [AdminController::class, 'getAdmin']);

Route::post('/course/add', [AdminController::class, 'getAdmin']);
Route::post('/course/update', [AdminController::class, 'getAdmin']);
Route::post('/course/delete', [AdminController::class, 'getAdmin']);


// Защищённые роуты (только для авторизованных)
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});
