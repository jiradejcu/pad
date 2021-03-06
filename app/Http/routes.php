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

Route::get('statistic/pad', 'StatisticController@pad');

Route::get('statistic/pad/med/{med_name?}', 'StatisticController@padMed');

Route::get('statistic/pad/med_hr/{med_name?}', 'StatisticController@padMedHr');

Route::get('statistic/apache_ii/outliner', 'StatisticController@outliner');

Route::get('statistic/apache_ii/{group?}', 'StatisticController@index');

Route::get('sql', 'StatisticController@sql');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
