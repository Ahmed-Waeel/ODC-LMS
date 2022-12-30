<?php

use App\Http\Controllers\adminApi\AuthController;
use App\Http\Controllers\adminApi\CategoryController;
use App\Http\Controllers\adminApi\CourseController;
use App\Http\Controllers\adminApi\ExamController;
use App\Http\Controllers\adminApi\QuestionController;
use App\Http\Controllers\adminApi\StudentController;
use App\Http\Controllers\adminApi\AdminController;
use App\Http\Controllers\adminApi\TrainerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




    Route::post('/login', [AuthController::class, 'login']);

    Route::group(['middleware'=>["auth:sanctum"]],function(){
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/generate/exam/{courseId}',[ExamController::class,'makeExam']);

        Route::get('/categories', [CategoryController::class , 'index']);
        Route::get('/categories/{id}', [CategoryController::class , 'indexById']);
        Route::post('/categories', [CategoryController::class , 'store']);
        Route::post('/categories/update/{id}', [CategoryController::class , 'update']);
        Route::get('/categories/delete/{id}', [CategoryController::class , 'delete']);

        Route::get('/courses', [CourseController::class , 'index']);
        Route::get('/courses/{id}', [CourseController::class , 'indexById']);
        Route::post('/courses', [CourseController::class , 'store']);
        Route::post('/courses/update/{id}', [CourseController::class , 'update']);
        Route::get('/courses/delete/{id}', [CourseController::class , 'delete']);


        Route::get('/students', [StudentController::class , 'index']);
        Route::get('/students/{id}', [StudentController::class , 'indexById']);
        Route::post('/students', [StudentController::class , 'store']);
        Route::post('/students/update/{id}', [StudentController::class , 'update']);
        Route::get('/students/delete/{id}', [StudentController::class , 'delete']);


        Route::get('/sub', [AdminController::class , 'index']);
        Route::get('/sub/{id}', [AdminController::class , 'indexById']);
        Route::post('/sub', [AdminController::class , 'store']);
        Route::post('/sub/update/{id}', [AdminController::class , 'update']);
        Route::get('/sub/delete/{id}', [AdminController::class , 'delete']);


        Route::get('/questions', [QuestionController::class , 'index']);
        Route::get('/questions/{id}', [QuestionController::class , 'indexById']);
        Route::post('/questions', [QuestionController::class , 'store']);
        Route::post('/questions/update/{id}', [QuestionController::class , 'update']);
        Route::get('/questions/delete/{id}', [QuestionController::class , 'delete']);


        Route::get('/trainers', [TrainerController::class , 'index']);
        Route::get('/trainers/{id}', [TrainerController::class , 'indexById']);
        Route::post('/trainers', [TrainerController::class , 'store']);
        Route::post('/trainers/update/{id}', [TrainerController::class , 'update']);
        Route::get('/trainers/delete/{id}', [TrainerController::class , 'delete']);




        Route::post('/enroll/{courseId}', [StudentController::class, 'enroll']);
        Route::post('/status/{courseId}', [StudentController::class, 'status']);
        Route::get('/request/code/{courseId}', [StudentController::class, 'requestCode']);

});



