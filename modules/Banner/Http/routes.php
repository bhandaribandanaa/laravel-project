<?php

Route::group(['prefix' => 'admin/banner', 'middleware' => 'admin', 'namespace' => 'Modules\Banner\Http\Controllers\Admin'], function () {
	Route::get('/', ['middleware' => 'access:gallery-management,access_view', 'as' => 'admin.banner.index', 'uses' => 'BannerController@index']);
	Route::get('add', ['middleware' => 'access:gallery-management,access_add', 'as' => 'admin.banner.add', 'uses' => 'BannerController@add']);
	Route::post('add', ['middleware' => 'access:gallery-management,access_add', 'as' => 'admin.banner.add', 'uses' => 'BannerController@create']);

	Route::post('delete', ['middleware' => 'access:gallery-management,access_delete', 'as' => 'admin.banner.delete', 'uses' => 'BannerController@delete']);

	Route::post('change-status', ['middleware' => 'access:gallery-management,access_publish', 'as' => 'admin.banner.change_status', 'uses' => 'BannerController@changeStatus']);

	Route::get('edit/{id}', ['middleware' => 'access:gallery-management,access_update', 'as' => 'admin.banner.edit', 'uses' => 'BannerController@edit']);
	Route::post('edit/{id}', ['middleware' => 'access:gallery-management,access_update', 'as' => 'admin.banner.edit', 'uses' => 'BannerController@update']);

});