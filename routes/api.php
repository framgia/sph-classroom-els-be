<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\User\UserController;
use App\Http\Controllers\API\v1\Category\CategoryController;
use App\Http\Controllers\API\v1\Quiz\QuizController;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\Auth\ForgotPasswordController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::resource('/users', UserController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/categories.quizzes', QuizController::class);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('reset-password', [ForgotPasswordController::class, 'reset']);
});

