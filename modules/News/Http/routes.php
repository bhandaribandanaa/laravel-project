<?php

Route::group(['prefix' => 'admin/news', 'middleware' => 'admin', 'namespace' => 'Modules\News\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.news.index',
                            'uses' => 'AdminNewsController@index']);

    Route::get('add', ['as' => 'admin.news.add',
                            'uses' => 'AdminNewsController@add']);

    Route::post('add/submit', ['as' => 'admin.news.addSubmit',
                            'uses' => 'AdminNewsController@addSubmit']);

    Route::get('edit/{id}', ['as' => 'admin.news.edit',
                            'uses' => 'AdminNewsController@edit']);

    Route::get('changeStatus/{id}/{option}', ['as' => 'admin.news.changeStatus',
                            'uses' => 'AdminNewsController@changeStatus']);

    Route::get('delete/{id}', ['as' => 'admin.news.delete',
                            'uses' => 'AdminNewsController@delete']);

    Route::post('edit/submit', ['as' => 'admin.news.editSubmit',
                            'uses' => 'AdminNewsController@editSubmit']);

    Route::post('edit/submit', ['as' => 'admin.news.editSubmit',
                            'uses' => 'AdminNewsController@editSubmit']);

    Route::get('categories', ['as' => 'admin.news.category',
                            'uses' => 'AdminNewsController@category']);

    Route::get('addCategory', ['as' => 'admin.news.addCategory',
                            'uses' => 'AdminNewsController@addCategory']);

    Route::get('editCategory/{id}', ['as' => 'admin.news.editCategory',
                            'uses' => 'AdminNewsController@editCategory']);

    Route::get('changeCategoryStatus/{id}/{option}', ['as' => 'admin.news.changeCategoryStatus',
                            'uses' => 'AdminNewsController@changeCategoryStatus']);

    Route::get('deleteCategory/{id}', ['as' => 'admin.news.deleteCategory',
                            'uses' => 'AdminNewsController@deleteCategory']);

    Route::post('addCategory/submit', ['as' => 'admin.news.addCategorySubmit',
                            'uses' => 'AdminNewsController@addCategorySubmit']);

    Route::post('editCategory/submit', ['as' => 'admin.news.editCategorySubmit',
                            'uses' => 'AdminNewsController@editCategorySubmit']);

    Route::get('removeImage/{id}', ['as' => 'admin.news.removeImage',
                            'uses' => 'AdminNewsController@removeImage']);


});

Route::group(['prefix' => 'news', 'namespace' => 'Modules\News\Http\Controllers'], function()
{
	Route::get('/', ['as' => 'news',
                        'uses' => 'NewsController@index']);

    Route::get('detail/{slug}', ['as' => 'news.detail',
                        'uses' => 'NewsController@detail']);

    Route::get('category/{slug}', ['as' => 'news.category',
                        'uses' => 'NewsController@category']);
});
