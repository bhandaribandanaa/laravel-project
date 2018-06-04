

<?php

Route::group(['prefix' => 'admin/applicants', 'middleware' => 'admin', 'namespace' => 'Modules\Applicant\Http\Controllers\Admin'], function () {

    Route::get('/', ['as' => 'admin.applicants.index',
                            'uses' => 'AdminApplicantController@index']);

   

    });

//for frontend 

Route::group(['prefix' => 'Applicant', 'namespace' => 'Modules\Applicant\Http\Controllers'], function()
{
	

	Route::get('add', ['as' => 'applicants.add',
                            'uses' => 'ApplicantController@add']);

    Route::post('add/submit', ['as' => 'applicants.addSubmit',
                            'uses' => 'ApplicantController@addSubmit']);

	
});

