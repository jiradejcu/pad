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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('patient', 'PatientController@index');

Route::get('patient/create', 'PatientController@create');

Route::post('patient/create', 'PatientController@store');

Route::get('pad', 'PadFormController@index');

Route::get('pad/create', 'PadFormController@create');

Route::post('pad/create', 'PadFormController@store');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
