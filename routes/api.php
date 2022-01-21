<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\User\UserController;
use App\Http\Controllers\API\v1\Category\CategoryController;
use App\Http\Controllers\API\v1\Quiz\QuizController;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\Quiz\QuestionController;
use App\Http\Controllers\API\v1\Auth\ForgotPasswordController;
use App\Http\Controllers\API\v1\Auth\ChangePasswordController;
use App\Http\Controllers\API\v1\Follow\FollowController;
use App\Http\Controllers\API\v1\Quiz\QuizAnswerController;
use App\Http\Controllers\API\v1\Quiz\QuizzesTakenController;
use App\Http\Controllers\API\v1\Student\StudentController;
use App\Http\Controllers\API\v1\User\UserRecentQuizzesController;
use App\Http\Controllers\API\v1\Student\StudentActivitiesController;
use App\Http\Controllers\API\v1\User\UserfriendsScoreController;
use App\Http\Controllers\API\v1\User\UserScoresAndAttemptsController;

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

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset']);

    // Authenticated routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);

        Route::resource('/users', UserController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/categories.quizzes', QuizController::class);
        Route::resource('/quizzes.questions', QuestionController::class);
        Route::resource('/quizzes-taken', QuizzesTakenController::class);
        Route::resource('/quizzes-taken.answers', QuizAnswerController::class);
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);

        Route::get('/students', [StudentController::class, 'index']);
        Route::get('/students/{id}', [StudentController::class, 'show']);
        Route::post('/follow', [FollowController::class, 'follow']);
        Route::post('/unfollow', [FollowController::class, 'unfollow']);
        Route::get('/recent-quizzes/{id}', [QuizzesTakenController::class, 'recent']);
        Route::get('/categories-learned/{id}', [QuizzesTakenController::class, 'learned']);
        Route::get('/recentQuizzes', [UserRecentQuizzesController::class, 'UserRecentquizzes']);
        Route::get('/studentslog/{id}', [StudentActivitiesController::class, 'studentActivities']);
        Route::get('/followedLog', [StudentActivitiesController::class, 'followedActivities']);

        Route::get('/friendscore/{quiz_id}', [UserfriendsScoreController::class, 'friendsScore']);
        Route::get('/quiz_attempts/{quiz_id}', [UserScoresAndAttemptsController::class, 'UserScoreAndAttempts']);
    });
});
