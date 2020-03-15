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

    Route::get('/', ['middleware' => 'guest', 'as' => 'main.index', 'uses' => 'MainController@index']);
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

    /*
    |--------------------------------------------------------------------------
    | Routes under "auth" middleware
    |--------------------------------------------------------------------------
    |
    | Authenticated users with any kind of "role" may have access
    | to routes that are listed, under "auth" middleware group.
    |
    */

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', ['as' => 'main.dashboard', 'uses' => 'MainController@dashboard']);
    
        /*
        |--------------------------------------------------------------------------
        | Routes under "auth" AND "student" middleware
        |--------------------------------------------------------------------------
        |
        | Only authenticated users, with "role" of "student" may have
        | access to routes listed under "student" middleware group.
        |
        */

        Route::group(['middleware' => 'student'], function () {

            Route::get('student/activities/enroll/{enrollmentkey}', [
                'uses' => 'StudentController@activitiesEnrollWithKey'
            ]);
            Route::get('student/activities/enroll', [
                'as' => 'student.activities.enroll',
                'uses' => 'StudentController@activitiesEnroll'
            ]);
            Route::post('student/activities/enroll', [
                'as' => 'student.activities.enroll.store',
                'uses' => 'StudentController@activitiesEnrollStore'
            ]);
            Route::get('student/activities/enrolled', [
                'as' => 'student.activities.enrolled',
                'uses' => 'StudentController@activitiesEnrolled'
            ]);
            Route::get('student/activities/enrolled/success', [
                'as' => 'student.activities.enrolled_success',
                'uses' => 'StudentController@activitiesEnrolledSuccess'
            ]);
            Route::get('student/activities/{activities}/enrolled', [
                'as' => 'student.activities.enrolled_show',
                'uses' => 'StudentController@activitiesEnrolledShow'
            ]);
            Route::post('student/activities/join', [
                'as' => 'student.activities.join',
                'uses' => 'StudentController@activitiesJoin'
            ]);
            Route::get('student/activities/evaluating', [
                'as' => 'student.activities.evaluating',
                'uses' => 'StudentController@activitiesEvaluating'
            ]);
            Route::post('student/activities/evaluating', [
                'as' => 'student.activities.evaluating.store',
                'uses' => 'StudentController@activitiesEvaluatingStore'
            ]);
            Route::get('student/activities/results', [
                'as' => 'student.activities.results',
                'uses' => 'StudentController@activitiesResults'
            ]);
            Route::get('student/activities/{activities}/results', [
                'as' => 'student.activities.results_show',
                'uses' => 'StudentController@activitiesResultsShow'
            ]);
            Route::get('student/activities/expired', [
                'as' => 'student.activities.expired',
                'uses' => 'StudentController@activitiesExpired'
            ]);
            Route::post('student/{student}/edit', [
                'as' => 'student.postEdit',
                'uses' => 'StudentController@update']);
            Route::resource('student', 'StudentController');

        });

        /*
        |--------------------------------------------------------------------------
        | Routes under "auth" AND "lecturer" middleware
        |--------------------------------------------------------------------------
        |
        | Only authenticated users, with "role" of "lecturer" may have
        | access to routes listed under "lecturer" middleware group.
        |
        */

        Route::group(['middleware' => 'lecturer'], function () {
            
            Route::resource('lecturer', 'LecturerController');

            // Lecturer-Activities custom routes: results
            Route::get('lecturer/{lecturer}/activities/results', [
                'as' => 'lecturer.activities.results', 
                'uses' => 'LecturerActivitiesController@results']);
            Route::get('lecturer/{lecturer}/activities/{activities}/results', [
                'as' => 'lecturer.activities.results.show', 
                'uses' => 'LecturerActivitiesController@resultsShow']);
            Route::get('lecturer/{lecturer}/activities/{activities}/results/student/{student}', [
                'as' => 'lecturer.activities.results.student.show', 
                'uses' => 'LecturerActivitiesController@resultsStudentShow']);

            // Lecturer-Activities custom routes: evaluation process
            Route::get('lecturer/{lecturer}/activities/{activities}/evaluate/student/{student}', [
                'as' => 'lecturer.activities.evaluate.student',
                'uses' => 'LecturerActivitiesController@evaluateStudent']);
            Route::get('lecturer/{lecturer}/activities/{activities}/evaluating/student/{student}', [
                'as' => 'lecturer.activities.evaluating.student',
                'uses' => 'LecturerActivitiesController@evaluatingStudent']);
            Route::get('lecturer/evaluating/expired/activity/{activity}/student/{student}', [
                'as' => 'lecturer.activities.evaluating.expired',
                'uses' => 'LecturerActivitiesController@evaluatingStudentExpired']);
            Route::get('lecturer/{lecturer}/activities/{activities}/evaluated/student/{student}', [
                'as' => 'lecturer.activities.evaluated.student',
                'uses' => 'LecturerActivitiesController@evaluatedStudent']);
            
            Route::get('lecturer/{lecturer}/activities/{activities}/confirmation', [
                'as' => 'lecturer.activities.confirmation',
                'uses' => 'LecturerActivitiesController@confirmation']);

            Route::post('lecturer/{lecturer}/activities/{activities}/update', [
                'as' => 'lecturer.activities.postEdit',
                'uses' => 'LecturerActivitiesController@update']);
            Route::post('lecturer/{lecturer}/edit', [
                'as' => 'lecturer.postEdit',
                'uses' => 'LecturerController@update']);
            Route::post('lecturer/evaluate/student', [
                'as' => 'lecturer.activities.evaluateStudentStore',
                'uses' => 'LecturerActivitiesController@evaluateStudentStore']);
            Route::resource('lecturer.activities', 'LecturerActivitiesController');

        }); // middleware "lecturer"


    }); // middleware "auth"

}); // middleware "web"
