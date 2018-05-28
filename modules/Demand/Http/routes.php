<?php

Route::group(['prefix' => 'admin/demands', 'middleware' => 'admin', 'namespace' => 'Modules\Demand\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.demands.index',
                            'uses' => 'AdminDemandController@index']);

    Route::get('add', ['as' => 'admin.demands.add',
                            'uses' => 'AdminDemandController@add']);

    Route::post('add/submit', ['as' => 'admin.demands.addSubmit',
                            'uses' => 'AdminDemandController@addSubmit']);

    Route::get('edit/{id}', ['as' => 'admin.demands.edit',
                            'uses' => 'AdminDemandController@edit']);

    Route::get('changeStatus/{id}/{option}', ['as' => 'admin.demands.changeStatus',
                            'uses' => 'AdminDemandController@changeStatus']);

    Route::get('delete/{id}', ['as' => 'admin.demands.delete',
                            'uses' => 'AdminDemandController@delete']);

    Route::post('edit/submit', ['as' => 'admin.demands.editSubmit',
                            'uses' => 'AdminDemandController@editSubmit']);

    Route::post('edit/submit', ['as' => 'admin.demands.editSubmit',
                            'uses' => 'AdminDemandController@editSubmit']);

    Route::get('categories', ['as' => 'admin.demands.category',
                            'uses' => 'AdminDemandController@category']);

    Route::get('addCategory', ['as' => 'admin.demands.addCategory',
                            'uses' => 'AdminDemandController@addCategory']);

    Route::get('editCategory/{id}', ['as' => 'admin.demands.editCategory',
                            'uses' => 'AdminDemandController@editCategory']);

    Route::get('changeCategoryStatus/{id}/{option}', ['as' => 'admin.demands.changeCategoryStatus',
                            'uses' => 'AdminDemandController@changeCategoryStatus']);

    Route::get('deleteCategory/{id}', ['as' => 'admin.demands.deleteCategory',
                            'uses' => 'AdminDemandController@deleteCategory']);

    Route::post('addCategory/submit', ['as' => 'admin.demands.addCategorySubmit',
                            'uses' => 'AdminDemandController@addCategorySubmit']);

    Route::post('editCategory/submit', ['as' => 'admin.demands.editCategorySubmit',
                            'uses' => 'AdminDemandController@editCategorySubmit']);

    Route::get('removeImage/{id}', ['as' => 'admin.demands.removeImage',
                            'uses' => 'AdminDemandController@removeImage']);

    });

//for frontend 

Route::group(['prefix' => 'Demand', 'namespace' => 'Modules\Demand\Http\Controllers'], function()
{
	Route::get('/', 'DemandController@index');

	Route::get('/contact-us', array('as' => 'pages.contact_us', 'uses' => 'DemandController@getContact'));
    Route::post('/contact-us', array('as' => 'pages.contact_us', 'uses' => 'DemandController@postContact'));

    Route::get('/gallery', array('as' => 'pages.gallery', 'uses' => 'DemandController@getGallery'));
    Route::get('/{slug}', array('as' => 'pages.detail', 'uses' => 'DemandController@getPageBySlug'));
});
































