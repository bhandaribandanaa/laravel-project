<?php

// Front ent Route for member


Route::group(['prefix' => 'member', 'before' => 'member', 'namespace' => 'Modules\Members\Http\Controllers'], function () {
    Route::get('/', array('as' => 'member.index', 'before' => 'csrf', 'uses' => 'MembersController@index'));
    Route::get('life-members', array('as' => 'member.life.members', 'uses' => 'MembersController@getLifeTimeMember'));
    Route::get('associate-members', array('as' => 'member.associate.members', 'uses' => 'MembersController@getAssociateMember'));
    // Route::get('info/{id}/{slug}', array('as' => 'member.detail', 'uses' => 'MembersController@memberInfo'));
    Route::get('login', array('as' => 'member.login', 'before' => 'csrf', 'uses' => 'AuthController@getLogin'));
    Route::post('login', array('as' => 'member.login','before'=>'csrf','uses'=>'AuthController@postLogin'));
    Route::get('register', array('as'=>'member.register', 'before' => 'csrf','uses' => 'MembersController@getRegister'));
    Route::post('register', array('as'=>'member.register', 'before' => 'csrf','uses' => 'MembersController@postRegister'));
    Route::get('new/register', array('as'=>'member.new.register', 'before' => 'csrf','uses' => 'MembersController@getNewMemberRegistration'));
    Route::post('new/register', array('as'=>'member.new.register', 'before' => 'csrf','uses' => 'MembersController@postNewMemberRegistration'));
    Route::get('forgotPassword', array('as' => 'member.forget.password', 'before' => 'csrf', 'uses' => 'AuthController@getForgetPasswordRequest'));
    Route::post('forgotPassword', array('as' => 'member.forget.password', 'before' => 'csrf', 'uses' => 'AuthController@forgetPasswordRequest'));
    Route::get('reset/{token}', array('as' => 'member.password_reset', 'uses' => 'AuthController@getReset'));
    Route::post('reset/{token}', array('as' => 'member.password_reset', 'uses' => 'AuthController@postReset'));
});
Route::group(['prefix' => 'member', 'middleware' => 'member', 'namespace' => 'Modules\Members\Http\Controllers'], function () {
    Route::get('info/{id}/{slug}', array('as' => 'member.detail', 'uses' => 'MembersController@memberInfo'));
    Route::get('dashboard', array('as' => 'member.dashboard', 'uses' => 'MembersController@dashboard'));
    Route::get('profile/edit', array('as' => 'member.profile.edit', 'uses' => 'MembersController@editProfile'));
    Route::post('profile/edit', array('as' => 'member.profile.edit', 'uses' => 'MembersController@updateProfile'));
    Route::get('logout', array('as' => 'member.logout', 'uses' => 'AuthController@memberLogout'));
    Route::get('profile/change-password', array('as' => 'member.change.password', 'uses' => 'AuthController@changePasswordRequest'));
    Route::post('profile/change-password', array('as' => 'member.change.password', 'uses' => 'AuthController@changePassword'));
});

// Admin Route for Member Modules
Route::group(['prefix' => 'admin/members', 'middleware' => 'admin', 'namespace' => 'Modules\Members\Http\Controllers\Admin'], function () {
    Route::get('/existing', ['middleware' => 'access:member-management,access_view', 'as' => 'admin.member.index', 'uses' => 'MembersController@index']);
    Route::get('/new', ['middleware' => 'access:member-management,access_view', 'as' => 'admin.member.new.index', 'uses' => 'MembersController@newMembers']);

    Route::get('/new/view/{id}', ['middleware' => 'access:member-management,access_view', 'as' => 'admin.member.new.view', 'uses' => 'MembersController@getNewMemberInfo']);
    Route::get('/new/approve/{id}', ['middleware' => 'access:member-management,access_view', 'as' => 'admin.member.new.approve', 'uses' => 'MembersController@approveNewMember']);

    //for existing members
    Route::get('/existing/view/{id}', ['middleware' => 'access:member-management,access_view', 'as' => 'admin.member.existing.view', 'uses' => 'MembersController@getExistingMemberInfo']);




    Route::get('add', ['middleware' => 'access:member-management,access_add', 'as' => 'admin.member.add', 'uses' => 'MembersController@add']);
    Route::post('add', ['middleware' => 'access:member-management,access_add', 'as' => 'admin.member.add', 'uses' => 'MembersController@create']);
    Route::post('change-status', ['middleware' => 'access:member-management,access_publish', 'as' => 'admin.member.change_status', 'uses' => 'MembersController@changeStatus']);
    Route::post('delete', ['middleware' => 'access:member-management,access_delete', 'as' => 'admin.member.delete', 'uses' => 'MembersController@delete']);
    Route::get('edit/{id}', ['middleware' => 'access:member-management,access_update', 'as' => 'admin.member.edit', 'uses' => 'MembersController@edit']);
    Route::post('edit/{id}', ['middleware' => 'access:member-management,access_update', 'as' => 'admin.member.edit', 'uses' => 'MembersController@update']);
});
