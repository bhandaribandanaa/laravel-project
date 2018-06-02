<?php



Route::group(['prefix' => 'admin/companydocument', 'middleware' => 'admin', 'namespace' => 'Modules\CompanyDocument\Http\Controllers\Admin'], function () {
    Route::get('/', [ 'as' => 'admin.companydocument.index', 'uses' => 'CompanyDocumentController@index']);
    Route::get('add', [ 'as' => 'admin.companydocument.add', 'uses' => 'CompanyDocumentController@addCompanyDocument']);
    Route::post('add', [ 'as' => 'admin.companydocument.add', 'uses' => 'CompanyDocumentController@createCompanyDocument']);

    Route::get('add-image/{id}', [ 'as' => 'admin.companydocument.photo.add', 'uses' => 'CompanyDocumentController@addCompanyDocumentImages']);
    Route::post('add-image/{id}', ['as' => 'admin.companydocument.photo.add', 'uses' => 'CompanyDocumentController@createCompanyDocumentImages']);
    Route::get('edit-image/{id}', [ 'as' => 'admin.companydocument.photo.edit', 'uses' => 'CompanyDocumentController@editCompanyDocumentImages']);

        Route::post('photo-delete', [ 'as' => 'admin.companydocument.photo.delete', 'uses' => 'CompanyDocumentController@deletePhoto']);

        Route::post('companydocument-change-status', ['as' => 'admin.companydocument.change_status', 'uses' => 'CompanyDocumentController@changeCompanyDocumentStatus']);

        Route::post('companydocument-delete', ['as' => 'admin.companydocument.delete', 'uses' => 'CompanyDocumentController@deleteCompanyDocument']);

    Route::get('edit/{id}', ['as' => 'admin.companydocument.edit', 'uses' => 'CompanyDocumentController@editCompanyDocument']);
    Route::post('edit/{id}', [ 'as' => 'admin.companydocument.edit', 'uses' => 'CompanyDocumentController@updateCompanyDocument']);

});

// companydocument frontend route

Route::group(['prefix' => 'companydocument', 'namespace' => 'Modules\CompanyDocument\Http\Controllers'], function()
{
    Route::get('/', ['as' => 'companydocument', 'uses' => 'CompanyDocumentController@index']);

    Route::get('images/{id}', ['as' => 'companydocument.all', 'uses' => 'CompanyDocumentController@all']);
});