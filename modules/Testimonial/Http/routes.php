<?php
// Testimonial Admin Routes
Route::group(['prefix' => 'admin/testimonial', 'middleware' => 'admin', 'namespace' => 'Modules\Testimonial\Http\Controllers\Admin'], function () {


	Route::get('testimonial/test', 'AdminTestimonialController@testMethod')->name('testimonial.test');


    Route::get('/', ['middleware' => 'access:testimonial-management,access_view', 'as' => 'admin.testimonial.index', 'uses' => 'AdminTestimonialController@index']);
    Route::get('add', ['middleware' => 'access:testimonial-management,access_add', 'as' => 'admin.testimonial.add', 'uses' => 'AdminTestimonialController@add']);
    Route::post('add', ['middleware' => 'access:testimonial-management,access_add', 'as' => 'admin.testimonial.add', 'uses' => 'AdmintestimonialController@create']);

    Route::get('edit/{id}', ['middleware' => 'access:testimonial-management,access_update', 'as' => 'admin.testimonial.edit', 'uses' => 'AdmintestimonialController@edit']);
    Route::post('edit/{id}', ['middleware' => 'access:testimonial-management,access_update', 'as' => 'admin.testimonial.edit', 'uses' => 'AdminTestimonialController@update']);

    Route::post('change-status', ['middleware' => 'access:testimonial-management,access_publish', 'as' => 'admin.testimonial.change_status', 'uses' => 'AdminTestimonialController@changeStatus']);
    Route::post('delete', ['middleware' => 'access:testimonial-management,access_delete', 'as' => 'admin.testimonial.delete', 'uses' => 'AdminTestimonialController@delete']);

});

//for frontend 

Route::group(['prefix' => 'testimonial', 'namespace' => 'Modules\Testimonial\Http\Controllers'], function()
{
	Route::get('/', 'TestimonialController@index');

	Route::get('/contact-us', array('as' => 'pages.contact_us', 'uses' => 'TestimonialController@getContact'));
    Route::post('/contact-us', array('as' => 'pages.contact_us', 'uses' => 'TestimonialController@postContact'));

    Route::get('/gallery', array('as' => 'pages.gallery', 'uses' => 'TestimonialController@getGallery'));
    Route::get('/{slug}', array('as' => 'pages.detail', 'uses' => 'TestimonialController@getPageBySlug'));
});

