<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', array('as' => 'home','uses' => 'HomeController@getHome'));
Route::post('subscribe-newsletter', array('as' => 'subscribe.newsletter','uses' => 'HomeController@subscribeNewsletter'));
Route::get('barcode', array('as' => 'barcode','uses' => 'BarcodeController@index'));
Route::get('barcode/attendance', array('as' => 'barcode.attendance', 'uses' => 'BarcodeController@getAttendance'));
Route::post('barcode/attendance', array('as' => 'barcode.attendance','uses' => 'BarcodeController@getAttendanceResult','before' => 'csrf'));
Route::get('barcode/lunch', array('as' => 'barcode.lunch', 'uses' => 'BarcodeController@getLunch'));
Route::post('barcode/lunch', array('as' => 'barcode.lunch','uses' => 'BarcodeController@getLunchResult','before' => 'csrf'));
Route::get('barcode/dinner', array('as' => 'barcode.dinner','uses' => 'BarcodeController@getDinner'));
Route::post('barcode/dinner', array('as' => 'barcode.dinner','uses' => 'BarcodeController@getDinnerResult','before' => 'csrf'));

Route::get('barcode/check', array('as' => 'barcode.check','uses' => 'BarcodeController@getCheck'));
Route::post('barcode/check', array('as' => 'barcode.check','uses' => 'BarcodeController@getCheckResult','before' => 'csrf'));


//
//Route::get('barcode', array('as' => 'barcode','uses' => 'BarcodeController@index'));
//Route::get('barcode/attendance', array('as' => 'barcode.attendance', 'middleware' => 'admin','uses' => 'BarcodeController@getAttendance'));
//Route::post('barcode/attendance', array('as' => 'barcode.attendance', 'middleware' => 'admin','uses' => 'BarcodeController@getAttendanceResult'));
//Route::get('barcode/lunch', array('as' => 'barcode.lunch', 'middleware' => 'admin','uses' => 'BarcodeController@getLunch'));
//Route::post('barcode/lunch', array('as' => 'barcode.lunch', 'middleware' => 'admin','uses' => 'BarcodeController@getLunchResult'));
//Route::get('barcode/dinner', array('as' => 'barcode.dinner', 'middleware' => 'admin','uses' => 'BarcodeController@getDinner'));
//Route::post('barcode/dinner', array('as' => 'barcode.dinner', 'middleware' => 'admin','uses' => 'BarcodeController@getDinnerResult'));

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    Route::get('/', array('as' => 'admin', 'uses' => 'AuthController@redirectLogin'));
    Route::get('login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
    Route::post('login', array('as' => '', 'before' => 'csrf', 'uses' => 'AuthController@postLogin'));
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard', array('as' => 'admin.dashboard', 'uses' => 'HomeController@index'));
    Route::get('logout', array('as' => 'admin.logout', 'uses' => 'Auth\AuthController@getLogout'));
});