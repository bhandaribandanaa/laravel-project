<?php
// Testimonial Admin Routes
Route::group(['prefix' => 'admin/testimonials', 'middleware' => 'admin', 'namespace' => 'Modules\Testimonial\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.testimonials.index',
                            'uses' => 'AdminTestimonialController@index']);

    Route::get('add', ['as' => 'admin.testimonials.add',
                            'uses' => 'AdminTestimonialController@add']);

    Route::post('add/submit', ['as' => 'admin.testimonials.addSubmit',
                            'uses' => 'AdminTestimonialController@addSubmit']);

    Route::get('edit/{id}', ['as' => 'admin.testimonials.edit',
                            'uses' => 'AdminTestimonialController@edit']);

    Route::get('changeStatus/{id}/{option}', ['as' => 'admin.testimonials.changeStatus',
                            'uses' => 'AdminTestimonialController@changeStatus']);

    Route::get('delete/{id}', ['as' => 'admin.testimonials.delete',
                            'uses' => 'AdminTestimonialController@delete']);

    Route::post('edit/submit', ['as' => 'admin.testimonials.editSubmit',
                            'uses' => 'AdminTestimonialController@editSubmit']);

    Route::post('edit/submit', ['as' => 'admin.testimonials.editSubmit',
                            'uses' => 'AdminTestimonialController@editSubmit']);

   



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

