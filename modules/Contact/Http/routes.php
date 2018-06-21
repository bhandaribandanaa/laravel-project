

<?php



Route::group(['prefix' => 'admin/contacts', 'middleware' => 'admin', 'namespace' => 'Modules\Contact\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.contacts.index',
                            'uses' => 'AdminContactController@index']);
  Route::get('delete/{id}', ['as' => 'admin.contacts.delete',
                            'uses' => 'AdminContactController@delete']);
   

    });

//for frontend 

Route::group(['prefix' => 'contact', 'namespace' => 'Modules\Contact\Http\Controllers'], function()
{
	

	Route::get('/', ['as' => 'contacts.add',
                            'uses' => 'ContactController@add']);

    Route::post('add/submit', ['as' => 'contacts.addSubmit',
                            'uses' => 'ContactController@addSubmit']);

	
});

