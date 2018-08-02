<?php

Route::group(['prefix' => 'admin/countries', 'middleware' => 'admin', 'namespace' => 'Modules\Countries\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.countries.index',
                            'uses' => 'AdminCountriesController@index']);

    Route::get('add', ['as' => 'admin.countries.add',
                            'uses' => 'AdminCountriesController@add']);

    Route::post('add/submit', ['as' => 'admin.countries.addSubmit',
                            'uses' => 'AdminCountriesController@addSubmit']);

    Route::get('edit/{id}', ['as' => 'admin.countries.edit',
                            'uses' => 'AdminCountriesController@edit']);

    Route::get('changeStatus/{id}/{option}', ['as' => 'admin.countries.changeStatus',
                            'uses' => 'AdminCountriesController@changeStatus']);

    Route::get('delete/{id}', ['as' => 'admin.countries.delete',
                            'uses' => 'AdminCountriesController@delete']);

    Route::post('edit/submit', ['as' => 'admin.countries.editSubmit',
                            'uses' => 'AdminCountriesController@editSubmit']);

    Route::post('edit/submit', ['as' => 'admin.countries.editSubmit',
                            'uses' => 'AdminCountriesController@editSubmit']);

   
    Route::get('removeImage/{id}', ['as' => 'admin.testimonials.removeImage',
                            'uses' => 'AdminCountriesController@removeImage']);

    });

Route::group(['prefix' => 'countries', 'namespace' => 'Modules\Countries\Http\Controllers'], function()
{

Route::get('countries', ['as' => 'countries', 'uses' => 'CountriesController@index']);
Route::get('countries/{slug}', ['as' => 'countries.detail', 'uses' => 'CountriesController@show']);

});