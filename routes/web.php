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

Route::resource('receive-sms','ReceiveSmsController');

Route::get('/send-message', 'CronJobController@sendMessage')->name('send-message');

Route::group(['middleware' => 'auth'], function() {

	Route::resource('profile','ProfileController');

	Route::resource('staff','StaffController');

	Route::get('staff/ajax/load','StaffController@ajaxLoad');

	Route::resource('patient','PatientController');

	Route::get('patient/ajax/load','PatientController@ajaxLoad');

	Route::resource('patient-service','PatientServiceController');

	Route::resource('patient-service-days','PatientReminderDaysController');

    Route::resource('reminder-sms','ReminderSmsController');

    Route::get('reminder-sms/ajax/{id}','ReminderSmsController@ajaxLoad');

	Route::resource('patient-service-time','PatientReminderTimeController');

    Route::post('receive-sms/ajax','ReceiveSmsController@ajaxLoad');

});

Route::group(['prefix' => 'staffs', 'namespace' => 'Staff'], function () {

    Route::get('/', 'Auth\LoginController@showLoginForm')->name('staffs');

    Route::post('login', 'Auth\LoginController@login')->name('staffs.login');

    Route::get('logout', 'Auth\LoginController@logout')->name('staffs.logout');

    Route::post('logout', 'Auth\LoginController@logout')->name('staffs.logout');

    Route::group(['middleware' => 'staff.auth'], function() {

    	Route::get('/home', 'HomeController@index')->name('staff.home');
    	
    	Route::resource('profile','ProfileController',['names'=>'staff.profile']);

    });

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/', 'Auth\LoginController@showLoginForm');

    Route::post('login', 'Auth\LoginController@login')->name('admin.login');

    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => 'admin.auth'], function() {

        Route::resource('dashboard', 'DashboardController');

        Route::resource('profile','ProfileController',['names'=>'admin.profile']);

        Route::resource('languages','LanguageController');

        Route::get('language/ajax/load','LanguageController@ajaxLoad');

        Route::resource('sms-message-types','ServiceSmsTypesController');

        Route::resource('sms-language-message','LanguageSmsMessageController');

        Route::resource('customers','CustomerController');

    });
});
