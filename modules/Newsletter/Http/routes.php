<?php


// Admin Route for newsletter Modules
Route::group(['prefix' => 'admin/newsletter', 'middleware' => 'admin', 'namespace' => 'Modules\Newsletter\Http\Controllers\Admin'], function () {
	Route::get('/', ['middleware' => 'access:content-management,access_view', 'as' => 'admin.newsletter.index', 'uses' => 'NewsletterController@index']);/**/
});