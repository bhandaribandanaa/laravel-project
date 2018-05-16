<?php

Route::group(['prefix' => 'packages', 'namespace' => 'Modules\Packages\Http\Controllers'], function()
{
	Route::get('/', ['as' => 'packages',
                        'uses' => 'PackagesController@index']);

    Route::get('view/{slug}', ['as' => 'packages.view',
                        'uses' => 'PackagesController@book']);

    Route::get('appointment/{package}/{doctor}', ['as' => 'packages.appointment',
                                        'uses' => 'PackagesController@appointment']);

    Route::get('getAppointment/{package}/{doctor}/{date}', ['as' => 'packages.getAppointment',
                                    'uses' => 'PackagesController@getAppointment']);

    Route::post('book', ['as' => 'packages.book',
                                        'uses' => 'PackagesController@bookPackage']);
});

Route::group(['prefix' => 'admin/packages', 'middleware' => 'admin', 'namespace' => 'Modules\Packages\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.packages.index',
    					 'uses' => 'AdminPackagesController@index']);

    Route::get('add', ['as' => 'admin.packages.add',
    					 'uses' => 'AdminPackagesController@add']);

    Route::post('add/submit', ['as' => 'admin.packages.addSubmit',
    					 'uses' => 'AdminPackagesController@addSubmit']);

    Route::get('edit/{id}', ['as' => 'admin.packages.edit',
    					 'uses' => 'AdminPackagesController@edit']);

    Route::post('edit/submit', ['as' => 'admin.packages.editSubmit',
    					 'uses' => 'AdminPackagesController@editSubmit']);

    Route::post('change-status', ['as' => 'admin.packages.change_status',
    								'uses' => 'AdminPackagesController@changeStatus']);
	
	Route::post('delete', ['as' => 'admin.packages.delete',
                         'uses' => 'AdminPackagesController@delete']);

    Route::get('assignDoctor/{id}', ['as' => 'admin.packages.assignDoctor',
                         'uses' => 'AdminPackagesController@assignDoctor']);

    Route::get('assign_doctors/{p_id}/{d_id}/{op}', ['as' => 'admin.packages.assign_doctors',
                         'uses' => 'AdminPackagesController@assign_doctors']);

    Route::get('viewTreatments', ['as' => 'admin.packages.viewTreatments',
                                'uses' => 'AdminPackagesController@viewTreatments']);

    Route::get('addTreatment', ['as' => 'admin.packages.addTreatment',
                                'uses' => 'AdminPackagesController@addTreatment']);

    Route::post('addTreatment/submit', ['as' => 'admin.packages.addTreatmentSubmit',
                                'uses' => 'AdminPackagesController@addTreatmentSubmit']);

    Route::post('change-statusTreatment', ['as' => 'admin.packages.change_statusTreatment',
                                    'uses' => 'AdminPackagesController@changeStatusTreatment']);

    Route::post('deleteTreatment', ['as' => 'admin.packages.deleteTreatment',
                                    'uses' => 'AdminPackagesController@deleteTreatment']);

    Route::get('editTreatment/{id}', ['as' => 'admin.packages.editTreatment',
                                        'uses' => 'AdminPackagesController@editTreatment']);

    Route::post('editTreatment/submit', ['as' => 'admin.packages.editTreatmentSubmit',
                                            'uses' => 'AdminPackagesController@editTreatmentSubmit']);

    Route::get('assignTreatment', ['as' => 'admin.packages.assignTreatment',
                                    'uses' => 'AdminPackagesController@assignTreatment']);

    Route::get('setTreatment/{value}', ['as' => 'admin.packages.setTreatment',
                                            'uses' => 'AdminPackagesController@setTreatment']);


});