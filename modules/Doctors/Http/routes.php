<?php

Route::group(['prefix' => 'doctors', 'namespace' => 'Modules\Doctors\Http\Controllers'], function()
{
	Route::get('/{slug?}', ['as' => 'doctors',
						'uses' => 'DoctorsController@index']);

    Route::get('appointment/{slug}', ['as' => 'doctors.appointment',
                        'uses' => 'DoctorsController@appointment']);

    Route::get('getAppointment/{slug}/{date}', ['as' => 'doctors.getAppointment',
                                            'uses' => 'DoctorsController@getAppointment']);

    Route::post('book', ['as' => 'doctors.book',
                        'uses' => 'DoctorsController@book']);

	
});


Route::group(['prefix' => 'api/doctors', 'namespace' => 'Modules\Doctors\Http\Controllers'], function()
{
    Route::get('appointment/{slug}/{sender_id}', ['as' => 'ApiDoctorsController.doctors.appointment',
        'uses' => 'ApiDoctorsController@appointment']);

    Route::get('getAppointment/{slug}/{date}/{sender_id}', ['as' => 'api.doctors.getAppointment',
        'uses' => 'ApiDoctorsController@getAppointment']);

    Route::post('book', ['as' => 'api.doctors.book',
        'uses' => 'ApiDoctorsController@book']);

    Route::get('sendSMS/{number}/{message}', ['as' => 'api.doctors.sendSMS',
        'uses' => 'ApiDoctorsController@sendSMS']);


});

Route::group(['prefix' => 'admin/doctors', 'middleware' => 'admin', 'namespace' => 'Modules\Doctors\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.doctors.index',
    					 'uses' => 'AdminDoctorsController@index']);

    Route::get('add', ['as' => 'admin.doctors.add',
    					 'uses' => 'AdminDoctorsController@add']);

    Route::post('add/submit', ['as' => 'admin.doctors.addSubmit',
    					 'uses' => 'AdminDoctorsController@addSubmit']);

    Route::post('change-status', ['as' => 'admin.doctors.change_status',
    								'uses' => 'AdminDoctorsController@changeStatus']);

    Route::get('edit/{id}', ['as' => 'admin.doctors.edit',
                         'uses' => 'AdminDoctorsController@edit']);

    Route::post('edit/submit', ['as' => 'admin.doctors.editSubmit',
                         'uses' => 'AdminDoctorsController@editSubmit']);


    Route::post('delete', ['as' => 'admin.doctors.delete',
                         'uses' => 'AdminDoctorsController@delete']);

    Route::post('untimeDelete', ['as' => 'admin.doctors.untimeDelete',
                                        'uses' => 'AdminDoctorsController@untimeDelete']);

    Route::get('timetable/{id}', ['as' => 'admin.doctors.timetable',
                         'uses' => 'AdminDoctorsController@timetable']);

    Route::get('setUnavailability/{id}', ['as' => 'admin.doctors.setUnavailability',
                                            'uses' => 'AdminDoctorsController@setUnavailability']);

    Route::post('unavailableSubmit', ['as' => 'admin.doctors.unavailableSubmit',
                                        'uses' => 'AdminDoctorsController@unavailableSubmit']);


    Route::get('addSchedule/{id}', ['as' => 'admin.doctors.addSchedule',
                                        'uses' => 'AdminDoctorsController@addSchedule']);

    Route::post('timeSubmit', ['as' => 'admin.doctors.timeSubmit',
                                 'uses' => 'AdminDoctorsController@timeSubmit']);

    Route::post('timeDelete', ['as' => 'admin.doctors.timeDelete',
                                    'uses' => 'AdminDoctorsController@timeDelete']);

    Route::post('change-time-status', ['as' => 'admin.doctors.change_time_status',
                                        'uses' => 'AdminDoctorsController@changeTimeStatus']);

    Route::get('editTime/{id}', ['as' => 'admin.doctors.editTime',
                                'uses' => 'AdminDoctorsController@editTime']);

    Route::post('editTime/submit', ['as' => 'admin.doctors.editTimeSubmit',
                                    'uses' => 'AdminDoctorsController@editTimeSubmit']);
});