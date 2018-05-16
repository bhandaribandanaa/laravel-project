<?php
/**
 * Route used to manage route of downloads module.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */

// content Front end route
Route::group(['prefix' => 'downloads', 'namespace' => 'Modules\Downloads\Http\Controllers'], function () {
    Route::get('files', array('as' => 'download.files', 'uses' => 'DownloadsController@getFiles'));
    Route::get('videos', array('as' => 'download.videos', 'uses' => 'DownloadsController@getVideos'));
});

// Content Admin Routes
Route::group(['prefix' => 'admin/downloads', 'middleware' => 'admin', 'namespace' => 'Modules\Downloads\Http\Controllers\Admin'], function () {

    // file
    Route::get('file', ['middleware' => 'access:downloads,access_view', 'as' => 'admin.download.file.index', 'uses' => 'DownloadsController@getFiles']);
    Route::get('file/add', ['middleware' => 'access:downloads,access_add', 'as' => 'admin.download.file.add', 'uses' => 'DownloadsController@addFile']);
    Route::post('file/add', ['middleware' => 'access:downloads,access_add', 'as' => 'admin.download.file.add', 'uses' => 'DownloadsController@createFile']);
    Route::get('file/edit/{id}', ['middleware' => 'access:downloads,access_update', 'as' => 'admin.downloads.file.edit', 'uses' => 'DownloadsController@editFile']);
    Route::post('file/edit/{id}', ['middleware' => 'access:downloads,access_update', 'as' => 'admin.downloads.file.edit', 'uses' => 'DownloadsController@updateFile']);

    // video

    Route::get('video', ['middleware' => 'access:downloads,access_view', 'as' => 'admin.download.video.index', 'uses' => 'DownloadsController@getVideos']);
    Route::get('video/add', ['middleware' => 'access:downloads,access_add', 'as' => 'admin.download.video.add', 'uses' => 'DownloadsController@addVideo']);
    Route::post('video/add', ['middleware' => 'access:downloads,access_add', 'as' => 'admin.download.video.add', 'uses' => 'DownloadsController@createVideo']);
    Route::get('video/edit/{id}', ['middleware' => 'access:downloads,access_update', 'as' => 'admin.downloads.video.edit', 'uses' => 'DownloadsController@editVideo']);
    Route::post('video/edit/{id}', ['middleware' => 'access:downloads,access_update', 'as' => 'admin.downloads.video.edit', 'uses' => 'DownloadsController@updateVideo']);

    Route::post('change-status', ['middleware' => 'access:downloads,access_publish', 'as' => 'admin.downloads.change_status', 'uses' => 'DownloadsController@changeStatus']);
    Route::post('delete', ['middleware' => 'access:downloads,access_delete', 'as' => 'admin.downloads.delete', 'uses' => 'DownloadsController@delete']);

    // category

    Route::get('category', ['middleware' => 'access:downloads,access_view', 'as' => 'admin.download.category.index', 'uses' => 'DownloadCategoryController@index']);
    Route::get('category/add', ['middleware' => 'access:downloads,access_add', 'as' => 'admin.download.category.add', 'uses' => 'DownloadCategoryController@add']);
    Route::post('category/add', ['middleware' => 'access:downloads,access_add', 'as' => 'admin.download.category.add', 'uses' => 'DownloadCategoryController@create']);
    Route::get('category/edit/{id}', ['middleware' => 'access:downloads,access_update', 'as' => 'admin.downloads.category.edit', 'uses' => 'DownloadCategoryController@edit']);
    Route::post('category/edit/{id}', ['middleware' => 'access:downloads,access_update', 'as' => 'admin.downloads.category.category.edit', 'uses' => 'DownloadCategoryController@update']);
    Route::post('category/change-status', ['middleware' => 'access:downloads,access_publish', 'as' => 'admin.downloads.category.change_status', 'uses' => 'DownloadCategoryController@changeStatus']);
    Route::post('category/delete', ['middleware' => 'access:downloads,access_delete', 'as' => 'admin.downloads.category.delete', 'uses' => 'DownloadCategoryController@delete']);

});

