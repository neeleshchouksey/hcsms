<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
	Route::resource('profile','ProfileController');
	Route::resource('staff','StaffController');
	Route::get('staff/ajax/load','StaffController@ajaxLoad');
	Route::resource('patient','PatientController');
	Route::get('patient/ajax/load','PatientController@ajaxLoad');
});
