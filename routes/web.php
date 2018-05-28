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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('receive-sms','ReceiveSmsController');

Route::post('receive-bpm-history','ReceiveSmsController@replyBpmHistory');

Route::get('/send-message', 'CronJobController@sendMessage')->name('send-message');

Route::get('/send-message-test', 'CronJobController@sendMessageTest')->name('send-message-test');

Route::get('/save-country', 'CronJobController@saveClickSendCountries');

Route::get('/sms-cost-charges', 'CronJobController@saveClickSendSmsPrice');

Route::get('/update-sms-price', 'CronJobController@updateMessagePrice');

Route::get('/end-message-reminder', 'CronJobController@endServiceReminder')->name('end-reminder');

Route::get('/update-send-messge', 'CronJobController@checkUpdateservice')->name('update-send-messge');

Route::get('/appointment-reminders', 'CronJobController@sendAppointmentReminders')->name('appointment-reminders');

Route::get('history/{id}','PatientServiceController@getPatientHistory');

Route::group(['namespace' => 'Sites'], function () {

    Route::get('/','HomeController@index')->name('site-home');

    Route::get('/about-us','AboutUsController@index')->name('site-about');

    Route::get('/service','ServiceController@index')->name('site-service');

    Route::get('/event','ServiceController@event')->name('site-event');

    Route::get('/pricing','ServiceController@pricing')->name('site-pricing');

    Route::get('/doctor','DoctorController@index')->name('site-doctor');

    Route::get('/our-doctor','DoctorController@ourDoctor')->name('site-our-doctor');

    Route::get('/gallery','GalleryController@index')->name('site-gallery');

    Route::get('/gallery-2','GalleryController@gallery2')->name('site-gallery-2');

    Route::get('/gallery-3','GalleryController@gallery3')->name('site-gallery-3');

    Route::get('/blog','BlogController@index')->name('site-blog');

    Route::get('/blog-single','BlogController@single')->name('site-blog-single');

    Route::get('/contact-us','ContactController@index')->name('site-contact');

    Route::get('/appointment','ContactController@appointment')->name('site-appointment');

});

Route::group(['middleware' => 'auth'], function() {

	Route::resource('profile','ProfileController');

    Route::post('update-info','ProfileController@updateInfo');

	Route::resource('staff','StaffController');

    Route::resource('patient-appointment','PatientAppointmentController');

    Route::put('patient-appointment-change/{patient_appointment}','PatientAppointmentController@updatePartial');

    Route::get('appt-reminder-services/{service}/{patient}','PatientAppointmentController@getReminderServiceMessages');

	Route::get('staff/ajax/load','StaffController@ajaxLoad');

	Route::resource('patient','PatientController');

	Route::get('patient/ajax/load','PatientController@ajaxLoad');

    Route::get('g-unique-id','PatientServiceController@generateUniqueId');

	Route::resource('patient-service','PatientServiceController');

	Route::resource('patient-service-days','PatientReminderDaysController');

    Route::resource('reminder-sms','ReminderSmsController');

    Route::get('reminder-sms/ajax/{id}','ReminderSmsController@ajaxLoad');

	Route::resource('patient-service-time','PatientReminderTimeController');

    Route::post('receive-sms/ajax','ReceiveSmsController@ajaxLoad');

    Route::post('send-simple-sms','SendSimpleMessageContoller@index');

});
Route::group(['middleware' => 'admin.auth'], function() {

    Route::resource('admin/patient-service','PatientServiceController');

    Route::resource('admin/patient-service-days','PatientReminderDaysController');

    Route::resource('admin/patient-service-time','PatientReminderTimeController');

    Route::resource('admin/reminder-sms','ReminderSmsController');

    Route::get('admin/appt-reminder-services/{service}/{patient}','PatientAppointmentController@getReminderServiceMessages');
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

    Route::get('/login', 'Auth\LoginController@showLoginForm');

    Route::post('login', 'Auth\LoginController@login')->name('admin.login');

    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::group(['middleware' => 'admin.auth'], function() {
        
        Route::resource('dashboard', 'DashboardController');

        Route::resource('profile','ProfileController',['names'=>'admin.profile']);

        Route::resource('languages','LanguageController');

        Route::get('language/ajax/load','LanguageController@ajaxLoad');

        Route::put('language/show-on-top/{language}','LanguageController@showOnTop');

        Route::resource('users','UsersController');

        Route::get('user/ajax/load','UsersController@ajaxLoad');

        Route::resource('sms-message-types','ServiceSmsTypesController');

        Route::resource('sms-language-message','LanguageSmsMessageController');

        Route::resource('customers','CustomerController');

        Route::get('customers/ajax/load','CustomerController@ajaxLoad');

        Route::resource('patients','PatientController');

        Route::get('patients/ajax/load','PatientController@ajaxLoad');

        Route::resource('messages-log','MessagesLogController');

        Route::get('sms-costing','SmsCostingController@index');

        Route::get('sms-costing/ajax','SmsCostingController@ajaxLoad');

        Route::get('sms-costing/export','SmsCostingController@exportCsv');

        Route::get('messages-log/ajax/load','MessagesLogController@ajaxLoad');

        Route::resource('reminders','ActiveRemindersController');

        Route::get('reminders/ajax/load','ActiveRemindersController@ajaxLoad');

    });
});
Route::get('/appt/{code}','PatientController@getPatientAppointments');
Route::get('/{id}','PatientServiceController@getPatientHistory');