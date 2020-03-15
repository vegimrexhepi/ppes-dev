<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    /*
    |--------------------------------------------------------------------------
    | Routes without any kind of middleware
    |--------------------------------------------------------------------------
    |
    | Here are listed routes that are accessible by anyone.
    |
    */

    Route::get('test', 'TestController@index')->name('testingroute');
    Route::get('fsee', 'TestController@fireStudentEvaluationEvent')->name('fireStudentEvaluationEvent');

    /*
    |--------------------------------------------------------------------------
    | Authentication routes
    |--------------------------------------------------------------------------
    |
    | All needed routes to make registering and authenticating possible.
    |
    | +----------+-------------------------+--------------------------------------------+------------+
    | | Method   | URI                     | Action                                     | Middleware |
    | +----------+-------------------------+--------------------------------------------+------------+
    | | POST     | login                   | Auth\AuthController@login                  | web,guest  |
    | | GET|HEAD | login                   | Auth\AuthController@showLoginForm          | web,guest  |
    | | GET|HEAD | logout                  | Auth\AuthController@logout                 | web        |
    | | POST     | password/email          | Auth\PasswordController@sendResetLinkEmail | web,guest  |
    | | POST     | password/reset          | Auth\PasswordController@reset              | web,guest  |
    | | GET|HEAD | password/reset/{token?} | Auth\PasswordController@showResetForm      | web,guest  |
    | | POST     | register                | Auth\AuthController@register               | web,guest  |
    | | GET|HEAD | register                | Auth\AuthController@showRegistrationForm   | web,guest  |
    | +----------+-------------------------+---------------------------------------------------------+
    |
    |
    */

    Route::auth();

