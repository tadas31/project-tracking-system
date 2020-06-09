<?php

use Illuminate\Http\Request;

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

//--------------------------------------------------------------------------
// Login.
//--------------------------------------------------------------------------
Route::group(['prefix' => 'admin'], function() {
    Route::post('login', 'Auth\AuthController@loginAdmin');
});

Route::post('login', 'Auth\AuthController@loginUser');



//--------------------------------------------------------------------------
// User.
//--------------------------------------------------------------------------
Route::group([

    'middleware' => 'jwt:user'

], function() {

    // Basic user actions.
    //--------------------------------------------------------------------------
    Route::post('/logout', 'Auth\AuthController@logoutUser');
    Route::post('/refresh', 'Auth\AuthController@refreshUser');
    Route::post('/me', 'Auth\AuthController@meUser');

    // Project.
    //--------------------------------------------------------------------------
    Route::get('/project', 'ProjectController@showAssociatedProjects');
    Route::get('/project/{id}', 'ProjectController@show')->middleware('check.permission:1|2|3|4');
    Route::post('/project', 'ProjectController@store');
    Route::put('/project/{id}', 'ProjectController@update')->middleware('check.permission');
    Route::put('/project/note/{id}', 'ProjectController@updateNotes')->middleware('check.permission:2|4');
    Route::delete('/project/{id}', 'ProjectController@destroy')->middleware('check.permission');

    // Class.
    //--------------------------------------------------------------------------
});

//--------------------------------------------------------------------------
// Admin.
//--------------------------------------------------------------------------
Route::group([

    'middleware' => 'jwt:admin',
    'prefix' => 'admin'

], function() {

    // Basic admin actions.
    //--------------------------------------------------------------------------
    Route::post('/logout', 'Auth\AuthController@logoutAdmin');
    Route::post('/refresh', 'Auth\AuthController@refreshAdmin');
    Route::post('/me', 'Auth\AuthController@meAdmin');

    // Project.
    //--------------------------------------------------------------------------
    Route::get('/project', 'ProjectController@index');

});

// Project.
//--------------------------------------------------------------------------
Route::get('/public/project', 'ProjectController@showPublicProjects');
