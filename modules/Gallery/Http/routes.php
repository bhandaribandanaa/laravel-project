<?php

/**
 * Route used to manage route of gallery module.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */

// gallery admin routes

Route::group(['prefix' => 'admin/gallery', 'middleware' => 'admin', 'namespace' => 'Modules\Gallery\Http\Controllers\Admin'], function () {
    Route::get('/', ['middleware' => 'access:gallery-management,access_view', 'as' => 'admin.gallery.index', 'uses' => 'GalleryController@index']);
    Route::get('add', ['middleware' => 'access:gallery-management,access_add', 'as' => 'admin.gallery.add', 'uses' => 'GalleryController@addGallery']);
    Route::post('add', ['middleware' => 'access:gallery-management,access_add', 'as' => 'admin.gallery.add', 'uses' => 'GalleryController@createGallery']);

    Route::get('add-image/{id}', ['middleware' => 'access:gallery-management,access_add', 'as' => 'admin.gallery.photo.add', 'uses' => 'GalleryController@addGalleryImages']);
    Route::post('add-image/{id}', ['middleware' => 'access:gallery-management,access_add', 'as' => 'admin.gallery.photo.add', 'uses' => 'GalleryController@createGalleryImages']);
    Route::get('edit-image/{id}', ['middleware' => 'access:gallery-management,access_update', 'as' => 'admin.gallery.photo.edit', 'uses' => 'GalleryController@editGalleryImages']);

        Route::post('photo-delete', ['middleware' => 'access:gallery-management,access_delete', 'as' => 'admin.gallery.photo.delete', 'uses' => 'GalleryController@deletePhoto']);

        Route::post('gallery-change-status', ['middleware' => 'access:gallery-management,access_publish', 'as' => 'admin.gallery.change_status', 'uses' => 'GalleryController@changeGalleryStatus']);

        Route::post('gallery-delete', ['middleware' => 'access:gallery-management,access_delete', 'as' => 'admin.gallery.delete', 'uses' => 'GalleryController@deleteGallery']);

    Route::get('edit/{id}', ['middleware' => 'access:gallery-management,access_update', 'as' => 'admin.gallery.edit', 'uses' => 'GalleryController@editGallery']);
    Route::post('edit/{id}', ['middleware' => 'access:gallery-management,access_update', 'as' => 'admin.gallery.edit', 'uses' => 'GalleryController@updateGallery']);

});

// gallery frontend route

Route::group(['prefix' => 'gallery', 'namespace' => 'Modules\Gallery\Http\Controllers'], function()
{
    Route::get('/', ['as' => 'gallery', 'uses' => 'GalleryController@index']);

    Route::get('images/{id}', ['as' => 'gallery.all', 'uses' => 'GalleryController@all']);
});