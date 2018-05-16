<?php

Route::group(['prefix' => 'admin/choose', 'middleware' => 'admin', 'namespace' => 'Modules\Choose\Http\Controllers\Admin'], function () {
	
	Route::get('/', ['as' => 'admin.choose.index', 'uses' => 'ChooseController@index']);

	Route::get('add', ['as' => 'admin.choose.add', 'uses' => 'ChooseController@add']);

	Route::post('add/submit', ['as' => 'admin.choose.addSubmit', 'uses' => 'ChooseController@addSubmit']);

	Route::get('edit/{id}', ['as' => 'admin.choose.edit', 'uses' => 'ChooseController@edit']);

	Route::post('edit/submit', ['as' => 'admin.choose.editSubmit', 'uses' => 'ChooseController@editSubmit']);

	Route::post('choose-delete', ['as' => 'admin.choose.delete', 'uses' => 'ChooseController@deleteChoose']);

	Route::post('choose-change-status', ['as' => 'admin.choose.change_status', 'uses' => 'ChooseController@changeChooseStatus']);

});