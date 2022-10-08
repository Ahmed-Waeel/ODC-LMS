<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', 'auth\LoginController@logout');


Auth::routes();
Route::group(['middleware' => 'auth','prefix'=>'/admin' ] , function(){
    Route::get('/', 'HomeController@index');
    Route::get('/categories', 'CategoryController@show');
    Route::get('/courses', 'CourseController@show');
    Route::get('/students', 'StudentController@show');
    Route::get('/admins', 'HomeController@getAdmins');
    Route::get('/questions', 'QuestionController@show');
    Route::get('/trainers' , 'TrainerController@show');

    Route::post('/store' , 'HomeController@store');
    Route::post('categories/store' , 'CategoryController@store');
    Route::post('courses/store' , 'CourseController@store');
    Route::post('questions/store' , 'QuestionController@store');
    Route::post('students/store' , 'StudentController@store');
    Route::post('trainers/store' , 'TrainerController@store');

    Route::get('/categories/{id}', 'CategoryController@delete');
    Route::get('/courses/{id}', 'CourseController@delete');
    Route::get('/students/{id}', 'StudentController@delete');
    Route::get('/admins/{id}', 'HomeController@delete');
    Route::get('/questions/{id}', 'QuestionController@delete');
    Route::get('/trainers/{id}' , 'TrainerController@delete');

    Route::get('/categories/edit/{id}', 'CategoryController@edit');
    Route::get('/courses/edit/{id}', 'CourseController@edit');
    Route::get('/students/edit/{id}', 'StudentController@edit');
    Route::get('/admins/edit/{id}', 'HomeController@edit');
    Route::get('/questions/edit/{id}', 'QuestionController@edit');
    Route::get('/trainers/edit/{id}' , 'TrainerController@edit');

    Route::post('/categories/update/{id}', 'CategoryController@update');
    Route::post('/courses/update/{id}', 'CourseController@update');
    Route::post('/students/update/{id}', 'StudentController@update');
    Route::post('/admins/update/{id}', 'HomeController@update');
    Route::post('/questions/update/{id}', 'QuestionController@update');
    Route::post('/trainers/update/{id}' , 'TrainerController@update');
});



