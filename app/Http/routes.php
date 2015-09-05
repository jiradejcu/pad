<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PatientController@index');

Route::get('home', 'HomeController@index');

Route::resource('patient', 'PatientController');

Route::resource('pad', 'PadController');

Route::get('pad/{id}/create', 'PadController@create');

Route::resource('drp', 'DrpController');

Route::get('drp/master/{id}', 'DrpController@getDrpMaster');

Route::resource('med', 'MedController');

Route::get('statistic', 'StatisticController@index');

Route::get('outliner', 'StatisticController@outliner');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
