<?php

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

    Route::get('categories', ['as' => 'admin.testimonials.category',
                            'uses' => 'AdminTestimonialController@category']);

    Route::get('addCategory', ['as' => 'admin.testimonials.addCategory',
                            'uses' => 'AdminTestimonialController@addCategory']);

    Route::get('editCategory/{id}', ['as' => 'admin.testimonials.editCategory',
                            'uses' => 'AdminTestimonialController@editCategory']);

    Route::get('changeCategoryStatus/{id}/{option}', ['as' => 'admin.testimonials.changeCategoryStatus',
                            'uses' => 'AdminTestimonialController@changeCategoryStatus']);

    Route::get('deleteCategory/{id}', ['as' => 'admin.testimonials.deleteCategory',
                            'uses' => 'AdminTestimonialController@deleteCategory']);

    Route::post('addCategory/submit', ['as' => 'admin.testimonials.addCategorySubmit',
                            'uses' => 'AdminTestimonialController@addCategorySubmit']);

    Route::post('editCategory/submit', ['as' => 'admin.testimonials.editCategorySubmit',
                            'uses' => 'AdminTestimonialController@editCategorySubmit']);

    Route::get('removeImage/{id}', ['as' => 'admin.testimonials.removeImage',
                            'uses' => 'AdminTestimonialController@removeImage']);

    });

//for frontend 

Route::group(['prefix' => 'testimonial', 'namespace' => 'Modules\Testimonial\Http\Controllers'], function()
{
	Route::get('/', 'TestimonialController@index');

	
});

