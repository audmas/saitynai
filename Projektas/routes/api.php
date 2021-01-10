<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers',
        'prefix'     => 'auth',
    ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile'); // grazina profili
        Route::post('refresh', 'AuthController@refresh'); // ??? buvo tutoriale
    }
);

Route::group(
    [
        'middleware' => 'api',
        'namespace'  => 'App\Http\Controllers',
    ],
    function ($router) {
        // userio ir admino funkcijos
        Route::resource('todos', 'TodoController');
        Route::post('/teachers','TeachersController@store');
        Route::get('/teachers','TeachersController@index');
        Route::get('/teachers/{id}','TeachersController@show');
        Route::put('/teachers/{id}','TeachersController@update');
        Route::delete('/teachers/{id}','TeachersController@delete');

        // tik admino funkcijos
        Route::post('/courses','CoursesController@store');
        Route::get('/courses', 'CoursesController@index');
        Route::get('/courses/{id}/', 'CoursesController@show');
        Route::get('/teachers/{id}/courses', 'CoursesController@TeacherIndex');
        Route::get('/teachers/{id}/courses/{id2}','CoursesController@TeacherONEIndex');
        Route::put('/courses/{id}','CoursesController@update');
        Route::delete('/courses/{id}','CoursesController@delete');
    }
);


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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



///svecio metodai
Route::post('/projects','App\Http\Controllers\ProjectController@store');
Route::get('/projects','App\Http\Controllers\ProjectController@index');
Route::get('/projects/{id}','App\Http\Controllers\ProjectController@show');
Route::put('/projects/{id}','App\Http\Controllers\ProjectController@update');
Route::delete('/projects/{id}','App\Http\Controllers\ProjectController@delete');






Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 400);
});