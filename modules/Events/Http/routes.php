<?php

/**
 * Route used to manage route of events module.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */

// events Admin Routes
Route::group(['prefix' => 'admin/events', 'middleware' => 'admin', 'namespace' => 'Modules\Events\Http\Controllers\Admin'], function () {
    Route::get('/', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.index', 'uses' => 'EventsController@index']);
    Route::get('add', ['middleware' => 'access:events-management,access_add', 'as' => 'admin.event.add', 'uses' => 'EventsController@add']);
    Route::post('add', ['middleware' => 'access:events-management,access_add', 'as' => 'admin.event.add', 'uses' => 'EventsController@create']);

    Route::get('edit/{id}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.edit', 'uses' => 'EventsController@edit']);
    Route::post('edit/{id}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.edit', 'uses' => 'EventsController@update']);

    Route::get('content/{id}', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.content.index', 'uses' => 'EventsController@getEventContent']);

    Route::get('content/{id}/add', ['middleware' => 'access:events-management,access_add', 'as' => 'admin.event.content.add', 'uses' => 'EventsController@contentAdd']);
    Route::post('content/{id}/add', ['middleware' => 'access:events-management,access_add', 'as' => 'admin.event.content.add', 'uses' => 'EventsController@contentCreate']);

    Route::get('content/{id}/edit/{content_id}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.content.edit', 'uses' => 'EventsController@editContent']);
    Route::post('content/{id}/edit/{content_id}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.content.edit', 'uses' => 'EventsController@updateContent']);


    Route::post('change-status', ['middleware' => 'access:events-management,access_publish', 'as' => 'admin.event.change_status', 'uses' => 'EventsController@changeStatus']);
    Route::post('content/change-status', ['middleware' => 'access:events-management,access_publish', 'as' => 'admin.event.content.change_status', 'uses' => 'EventsController@ContentChangeStatus']);

    Route::post('delete', ['middleware' => 'access:events-management,access_delete', 'as' => 'admin.event.delete', 'uses' => 'EventsController@delete']);
    Route::post('content/delete', ['middleware' => 'access:events-management,access_delete', 'as' => 'admin.event.content.delete', 'uses' => 'EventsController@deleteEventContent']);

    Route::get('/participants/{id}/{slug}', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.participants', 'uses' => 'ParticipantController@getEventParticipants']);
    Route::get('/participants/{id}/{slug}/download', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.participant.download', 'uses' => 'ParticipantController@downloadAllParticipants']);

    Route::get('/participants/{id}/{slug}/attendance', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.participants.attendance', 'uses' => 'ParticipantController@getEventParticipantsAttendance']);

    Route::get('/participants/{id}/{slug}/add', ['middleware' => 'access:events-management,access_add', 'as' => 'admin.event.participants.add', 'uses' => 'ParticipantController@addEventParticipants']);
    Route::post('/participants/{id}/{slug}/add', ['middleware' => 'access:events-management,access_add', 'as' => 'admin.event.participants.add', 'uses' => 'ParticipantController@createEventParticipants']);

    Route::get('/participants/{id}/{slug}/edit/{participantId}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.participant.edit', 'uses' => 'ParticipantController@editParticipants']);
    Route::post('/participants/{id}/{slug}/edit/{participantId}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.participant.edit', 'uses' => 'ParticipantController@updateParticipants']);

    Route::post('/participants/update_barcode', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.participant.update.barcode', 'uses' => 'ParticipantController@updateParticipantsBarcode']);

    Route::post('delete-participant', ['middleware' => 'access:events-management,access_delete', 'as' => 'admin.event.participant.delete', 'uses' => 'ParticipantController@deleteParticipant']);
    Route::get('download-ticket/{id}/{eventid}', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.participant.ticket.download', 'uses' => 'ParticipantController@downloadParticipantTicket']);
    Route::get('download-all-barcode/{eventid}', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.participant.barcode.download', 'uses' => 'ParticipantController@downloadAllBarcode']);

    // for unassigned barcode
    Route::get('download-unassigned-barcode/{eventid}', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.participant.unassigned.barcode.download', 'uses' => 'ParticipantController@downloadUnAssignedBarcode']);
    // unassigned barcode ends

    Route::get('participant/payment/{eventid}/{id}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.participant.payment.update', 'uses' => 'ParticipantController@editPayment']);
    Route::post('participant/payment/{eventid}/{id}', ['middleware' => 'access:events-management,access_update', 'as' => 'admin.event.participant.payment.update', 'uses' => 'ParticipantController@updatePayment']);

});

Route::group(['prefix' => 'admin/events/registration', 'middleware' => 'admin', 'namespace' => 'Modules\Events\Http\Controllers\Admin'], function () {
    Route::get('/{eventid}', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.register.type', 'uses' => 'EventsRegistrationTypeController@index']);
    Route::get('/{eventid}/permission/{typeId}', ['middleware' => 'access:events-management,access_view', 'as' => 'admin.event.register.type.permission', 'uses' => 'EventsRegistrationTypeController@registerTypePermission']);

    Route::post('change-permission', ['as'=>'admin.event.registrationType.changePermission', 'uses'=>'EventsRegistrationTypeController@changePermission'] );
});

// event Front end route
Route::group(['prefix' => 'events', 'namespace' => 'Modules\Events\Http\Controllers'], function () {
//    Route::get('/', array('as' => 'events.index', 'uses' => 'EventsController@index'));
    Route::get('/{slug}/', array('as' => 'events.type.index', 'uses' => 'EventsController@getEventBySlug'));
    Route::get('/detail/{id}/{slug}', array('as' => 'event.detail', 'uses' => 'EventsController@getDetail'));
    Route::get('/detail/{id}/{slug}/register', array('as' => 'event.registration', 'uses' => 'EventsController@register'));
    Route::post('/detail/{id}/{slug}/register', array('as' => 'event.registration', 'uses' => 'EventsController@postRegistration'));
    Route::get('/detail/{id}/{slug}/{contentSlug}', array('as' => 'event.detail.content', 'uses' => 'EventsController@getEventContent'));

});