<?php
/**
 * Route used to manage route of contents module.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */

// Content Admin Routes
Route::group(['prefix' => 'admin/content', 'middleware' => 'admin', 'namespace' => 'Modules\Content\Http\Controllers\Admin'], function () {
    Route::get('/', ['middleware' => 'access:content-management,access_view', 'as' => 'admin.content.index', 'uses' => 'AdminContentController@index']);
    Route::get('add', ['middleware' => 'access:content-management,access_add', 'as' => 'admin.content.add', 'uses' => 'AdminContentController@add']);
    Route::post('add', ['middleware' => 'access:content-management,access_add', 'as' => 'admin.content.add', 'uses' => 'AdminContentController@create']);

    Route::get('edit/{id}', ['middleware' => 'access:content-management,access_update', 'as' => 'admin.content.edit', 'uses' => 'AdminContentController@edit']);
    Route::post('edit/{id}', ['middleware' => 'access:content-management,access_update', 'as' => 'admin.content.edit', 'uses' => 'AdminContentController@update']);

    Route::post('change-status', ['middleware' => 'access:content-management,access_publish', 'as' => 'admin.content.change_status', 'uses' => 'AdminContentController@changeStatus']);
    Route::post('delete', ['middleware' => 'access:content-management,access_delete', 'as' => 'admin.content.delete', 'uses' => 'AdminContentController@delete']);

});

// content Front end route
Route::group(['prefix' => 'pages', 'namespace' => 'Modules\Content\Http\Controllers'], function () {
    Route::get('/contact-us', array('as' => 'pages.contact_us', 'uses' => 'ContentController@getContact'));
    Route::post('/contact-us', array('as' => 'pages.contact_us', 'uses' => 'ContentController@postContact'));
    Route::get('/gallery', array('as' => 'pages.gallery', 'uses' => 'ContentController@getGallery'));
    Route::get('/{slug}', array('as' => 'pages.detail', 'uses' => 'ContentController@getPageBySlug'));
});