
<?php
{
      

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



Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    Route::get('/', array('as' => 'admin', 'uses' => 'AuthController@redirectLogin'));
    Route::get('login', array('as' => 'admin.login', 'uses' => 'AuthController@getLogin'));
    Route::post('login', array('as' => '', 'before' => 'csrf', 'uses' => 'AuthController@postLogin'));
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard', array('as' => 'admin.dashboard', 'uses' => 'HomeController@index'));
    Route::get('logout', array('as' => 'admin.logout', 'uses' => 'Auth\AuthController@getLogout'));
});

Route::get('/applyOnline', ['as' => 'applyOnline',
                            'uses' => 'HomeController@getJobApply']);

    Route::post('applyOnline/submit', ['as' => 'applyOnlineSubmit',
                            'uses' => 'HomeController@getjobApplySubmit']);

	}
//frontend part
// Route::get('/front', function () {
//    return view('frontend.index');
// });
Route::get('/front/home','FrontController@index');
 
 // Route::get('/front/{slug}','FrontController@getPageBySlug');
Route::get('/front/contact','FContactController@index');
// Route::get('/', ['as' => 'contacts.add',
//                             'uses' => 'ContactController@add']);
Route::post('front/submit', 'FContactController@addSubmit');

Route::get('/front/submit','FContactController@addsubmit');
Route::get('/front/cat_detail','FCatdetailController@index');
Route::get('/front/company-introduction','FCompanyintroController@index');
Route::get('/front/vision','FVisionController@index');
Route::get('/front/procedure','FProcedureController@index');
Route::get('/front/message-from-managing-director','FMessageController@index');
Route::get('/front/professional','FProfessionalController@index');
Route::get('/front/skilled-labor','FSkilledController@index');
Route::get('/front/unskilled-labor','FUnskilledController@index');
Route::get('/front/semi-skilled-labor','FSemiskilledController@index');
Route::get('/front/hotelservice-industry','FHotelController@index');
Route::get('/front/domestic-maid','FDomesticController@index');
Route::get('/front/about-us-1','FAboutController@index');
Route::get('/front/turkish-language-class','FTurkishController@index');
Route::get('/front/education-training-1','FEducationController@index');
Route::get('/front/about-nepal','FAboutNepalController@index');
Route::get('/front/why-recruit-from-nepal','FRecruitNepalController@index');
// Route::get('/{slug}', array('as' => 'pages.detail', 'uses' => 'ContentController@getPageBySlug'));