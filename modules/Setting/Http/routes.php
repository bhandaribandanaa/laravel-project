<?php

Route::group(['prefix' => 'admin/settings', 'middleware' => 'admin', 'namespace' => 'Modules\Setting\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.settings.index',
                            'uses' => 'AdminSettingController@index']);

    Route::get('add', ['as' => 'admin.settings.add',
                            'uses' => 'AdminSettingController@add']);

    Route::post('add/submit', ['as' => 'admin.settings.addSubmit',
                            'uses' => 'AdminSettingController@addSubmit']);

    Route::get('edit/{id}', ['as' => 'admin.settings.edit',
                            'uses' => 'AdminSettingController@edit']);
    Route::post('edit/submit', ['as' => 'admin.settings.editSubmit',
                            'uses' => 'AdminSettingController@editSubmit']);

    Route::get('changeStatus/{id}/{option}', ['as' => 'admin.settings.changeStatus',
                            'uses' => 'AdminSettingController@changeStatus']);

    Route::get('delete/{id}', ['as' => 'admin.settings.delete',
                            'uses' => 'AdminSettingController@delete']);

    

    });

//for frontend 

Route::group(['prefix' => 'Setting', 'namespace' => 'Modules\Setting\Http\Controllers'], function()
{
	Route::get('/', 'SettingController@index');


});




