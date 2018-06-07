

<?php

if(!Session::has('settings')){
        $settings = \Modules\Setting\Entities\Setting::lists('value', 'slug')->toArray();
        Session::put('settings', $settings);}

Route::group(['prefix' => 'admin/contacts', 'middleware' => 'admin', 'namespace' => 'Modules\Contact\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.contacts.index',
                            'uses' => 'AdminContactController@index']);

   

    });

//for frontend 

Route::group(['prefix' => 'contact', 'namespace' => 'Modules\Contact\Http\Controllers'], function()
{
	

	Route::get('add/', ['as' => 'contacts.add',
                            'uses' => 'ContactController@add']);

    Route::post('add/submit', ['as' => 'contacts.addSubmit',
                            'uses' => 'ContactController@addSubmit']);

	
});

