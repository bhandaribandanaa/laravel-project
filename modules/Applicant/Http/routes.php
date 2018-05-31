<?php

Route::group(['prefix' => 'applicant', 'namespace' => 'Modules\Applicant\Http\Controllers'], function()
{
	Route::get('/', 'ApplicantController@index');
});