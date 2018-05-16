<?php

Route::group(['prefix' => 'admin/services', 'middleware' => 'admin', 'namespace' => 'Modules\Services\Http\Controllers\Admin'], function () {
    Route::get('/', ['as' => 'admin.services.index',
                        'uses' => 'AdminServicesController@index']);

    Route::get('add', ['as' => 'admin.services.add',
                        'uses' => 'AdminServicesController@add']);

    Route::post('add/submit', ['as' => 'admin.services.addSubmit',
                        'uses' => 'AdminServicesController@addSubmit']);

    Route::post('change-status', ['as' => 'admin.services.change_status',
                        'uses' => 'AdminServicesController@changeStatus']);

    Route::post('delete', ['as' => 'admin.services.delete',
                        'uses' => 'AdminServicesController@delete']);

    Route::get('edit/{id}', ['as' => 'admin.services.edit',
                        'uses' => 'AdminServicesController@edit']);

    Route::post('edit/submit', ['as' => 'admin.services.editSubmit',
                        'uses' => 'AdminServicesController@editSubmit']);

});

Route::group(['prefix' => 'services', 'namespace' => 'Modules\Services\Http\Controllers'], function()
{
	Route::get('/', ['as' => 'services',
                        'uses' => 'ServicesController@index']);
});

