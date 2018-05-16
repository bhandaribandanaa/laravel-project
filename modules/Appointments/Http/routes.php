<?php

Route::group(['prefix' => 'appointments', 'namespace' => 'Modules\Appointments\Http\Controllers'], function()
{
	Route::get('/', 'AppointmentsController@index');
});

Route::group(['prefix' => 'admin/appointments', 'middleware' => 'admin', 'namespace' => 'Modules\Appointments\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.appointments.index',
             'uses' => 'AdminAppointmentsController@index']);

    Route::get('manual-appointment', ['as' => 'admin.appointments.manualAppointment',
                'uses' => 'AdminAppointmentsController@manualAppointment']);

    Route::post('manual-appointment/select-date', ['as' => 'admin.appointments.manualAppointmentSubmit',
                'uses' => 'AdminAppointmentsController@manualAppointmentSubmit']);

    Route::post('manual-appointment/submit', ['as' => 'admin.appointments.manualAppointmentFinal',
                'uses' => 'AdminAppointmentsController@manualAppointmentFinal']);

    Route::get('manual-booking', ['as' => 'admin.appointments.manualBooking',
                'uses' => 'AdminAppointmentsController@manualBooking']);

    Route::post('manual-booking/select-date', ['as' => 'admin.appointments.manualBookingSubmit',
               'uses' => 'AdminAppointmentsController@manualBookingSubmit']);

    Route::post('manual-booking/submit', ['as' => 'admin.appointments.manualBookingFinal',
                'uses' => 'AdminAppointmentsController@manualBookingFinal']);

    Route::get('getDoctors/{package_id}', ['as' => 'admin.appointments.getDoctors',
                'uses' => 'AdminAppointmentsController@getDoctors']);

    Route::get('successful', ['as' => 'admin.appointments.successful',
            'uses' => 'AdminAppointmentsController@successful']);

    Route::get('packages/successful', ['as' => 'admin.appointments.successfulPackages',
             'uses' => 'AdminAppointmentsController@successfulPackages']);

    Route::get('pending', ['as' => 'admin.appointments.pending',
        'uses' => 'AdminAppointmentsController@pending']);

    Route::get('change-schedule/{app_id}/{doctor_id}', ['as' => 'admin.appointments.changeSchedule',
                'uses' => 'AdminAppointmentsController@changeSchedule']);

    Route::get('change-schedule-package/{app_id}/{doctor_id}', ['as' => 'admin.appointments.changeSchedulePackage',
                'uses' => 'AdminAppointmentsController@changeSchedulePackage']);

    Route::get('get-schedule/{slug}/{date}', ['as' => 'admin.appointments.getSchedule',
                    'uses' => 'AdminAppointmentsController@getSchedule']);

    Route::post('update-schedule', ['as' => 'admin.appointments.updateSubmit',
                        'uses' => 'AdminAppointmentsController@updateSubmit']);

    Route::post('update-package-schedule', ['as' => 'admin.appointments.updatePackageSubmit',
                        'uses' => 'AdminAppointmentsController@updatePackageSubmit']);

    Route::post('change-status', ['as' => 'admin.appointments.change_status',
                    'uses' => 'AdminAppointmentsController@changeStatus']);

    Route::post('change-success', ['as' => 'admin.appointments.change_success',
                    'uses' => 'AdminAppointmentsController@changeSuccess']);

    Route::post('change-success-package', ['as' => 'admin.appointments.change_successPackage',
                    'uses' => 'AdminAppointmentsController@changeSuccessPackage']);

    Route::post('change-confirm', ['as' => 'admin.appointments.change_confirm',
                    'uses' => 'AdminAppointmentsController@changeConfirm']);

    Route::post('change-confirm-package', ['as' => 'admin.appointments.change_confirmPackage',
                    'uses' => 'AdminAppointmentsController@changeConfirmPackage']);

    Route::get('packages', ['as' => 'admin.appointments.packages',
                        'uses' => 'AdminAppointmentsController@packages']);

    Route::get('packages/pending', ['as' => 'admin.appointments.pendingPackages',
                                'uses' => 'AdminAppointmentsController@pendingPackages']);

    Route::post('change-statusPackage', ['as' => 'admin.appointments.change_statusPackage',
                                    'uses' => 'AdminAppointmentsController@changeStatusPackage']);


});