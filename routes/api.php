<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\User\UserController;
use App\Http\Controllers\API\v1\Category\CategoryController;
use App\Http\Controllers\API\v1\Quiz\QuizController;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\ChangeNameEmailController;
use App\Http\Controllers\API\v1\Quiz\QuestionController;
use App\Http\Controllers\API\v1\Auth\ForgotPasswordController;
use App\Http\Controllers\API\v1\Auth\ChangePasswordController;
use App\Http\Controllers\API\v1\Follow\FollowController;
use App\Http\Controllers\API\v1\Quiz\QuizAnswerController;
use App\Http\Controllers\API\v1\Quiz\QuizzesTakenController;
use App\Http\Controllers\API\v1\Student\StudentController;
use App\Http\Controllers\API\v1\User\UserRecentQuizzesController;
use App\Http\Controllers\API\v1\Student\StudentActivitiesController;
use App\Http\Controllers\API\v1\User\UploadImageController;
use App\Http\Controllers\API\v1\User\UserfriendsScoreController;
use App\Http\Controllers\API\v1\User\UserScoresAndAttemptsController;
use App\Http\Controllers\API\v1\Learn\LearningsController;
use App\Http\Controllers\API\v1\Admin\AdminController;

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

    Route::patch('/admin/set-password', [AdminController::class, 'setNewPassword']);

    // Authenticated routes
    Route::middleware(['auth:sanctum', 'api',])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);

        Route::resource('/users', UserController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/categories.quizzes', QuizController::class);
        Route::resource('/quizzes.questions', QuestionController::class);
        Route::resource('/quizzes-taken', QuizzesTakenController::class);
        Route::resource('/quizzes-taken.answers', QuizAnswerController::class);
        Route::post('/change-password', [ChangePasswordController::class, 'changePassword']);
        Route::get('/learnings', [LearningsController::class, 'show']);

        Route::get('/students', [StudentController::class, 'index']);
        Route::get('/students/{id}', [StudentController::class, 'show']);
        Route::post('/follow', [FollowController::class, 'follow']);
        Route::post('/unfollow', [FollowController::class, 'unfollow']);
        Route::get('/recent-quizzes/{id}', [QuizzesTakenController::class, 'recent']);
        Route::get('/categories-learned/{id}', [QuizzesTakenController::class, 'learned']);
        Route::get('/recentQuizzes', [UserRecentQuizzesController::class, 'UserRecentquizzes']);
        Route::get('/studentslog/{id}', [StudentActivitiesController::class, 'studentActivities']);
        Route::get('/followedLog', [StudentActivitiesController::class, 'followedActivities']);
        Route::get('/categories/{category_id}/relatedQuizzes/{quiz_id}', [QuizController::class, 'relatedQuizzes']);
        Route::get('/friendscore/{quiz_id}', [UserfriendsScoreController::class, 'friendsScore']);
        Route::get('/quiz_attempts/{quiz_id}', [UserScoresAndAttemptsController::class, 'UserScoreAndAttempts']);
        Route::post('/profileEdit', [ChangeNameEmailController::class, 'changeName']);
        Route::post('/profileEdituploadImage', [UploadImageController::class, 'uploadAvatar']);
        Route::patch('/edit/password', [StudentController::class, 'updatePassword']);

        //Admin Routes
        Route::post('/admin/create', [AdminController::class, 'store']);
        Route::get('/admin_quizzes', [QuizController::class, 'adminQuiz']);
        Route::post('/admin/add-quiz', [QuizController::class, 'addQuiz']);
        Route::post('/admin/add-category', [CategoryController::class, 'store']);
        Route::get('/admin/categories-data', [CategoryController::class, 'getCategories']);
        Route::post('/admin_add_question', [QuestionController::class, 'addQuestion']);
        Route::post('/admin_add_choices', [QuestionController::class, 'addChoices']);
        Route::post('/admin_edit_question', [QuestionController::class, 'editQuestion']);
        Route::post('/admin_edit_choices', [QuestionController::class, 'editChoices']);
        Route::get('/admin/nested-categories/{subcategory_id}', [CategoryController::class, 'getSubcategoryParentCategories']);
        Route::post('/admin/profile-edit', [ChangeNameEmailController::class, 'restore']);
        Route::patch('/admin/password-edit', [AdminController::class, 'updatePassword']);
        Route::get('/admin/users', [AdminController::class, 'getAdminAccounts']);
        Route::get('/admin/categories', [CategoryController::class, 'listOfCategories']);
        Route::delete('/admin/delete-quiz/{quiz_id}', [QuizController::class, 'deleteQuiz']);
        Route::delete('/admin/delete-admin/{admin_id}', [AdminController::class, 'deleteAdmin']);
        Route::delete('/admin/delete-category/{id}', [CategoryController::class, 'deleteCategory']);
    });
});
