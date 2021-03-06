<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('test', 'Test@index');

// Authentication Routes...
$this->get('alogin', 'Auth\LoginController@showLoginForm')->name('alogin');
$this->post('alogin', 'Auth\LoginController@login');
$this->post('alogout', 'Auth\LoginController@logout')->name('alogout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('getuser/{user_id}', 'GetUserInfo@get');
Route::get('getmedias/{user_id}', 'GetMediaInfo@get');
Route::get('getmedias/{user_id}/{media_id}', 'GetMediaInfo@get');

Route::get('getfollowers/{user_id}', 'getFollowers@get');
Route::get('getfollowers/{user_id}/{max_id}', 'getFollowers@get');

Route::get('verifyme', 'CaptchaController@index');
Route::post('verifycaptcha', 'CaptchaController@verify');

Route::group(['middleware' => [/*'CheckForBot'*/]], function () {

  Route::get('login', 'IPController@login');
  Route::get('login/facebook/', 'IPController@facebook');

  Route::post('login', 'IPController@login_confirm');
  Route::post('login-challenge', 'IPController@confirm_code');
  Route::post('login-rechallenge', 'IPController@resend_code');

  Route::post('login/facebook/', 'IPController@facebook_token');

  Route::get('queue/shedule', 'QueueController@index');
  Route::get('queue/process', 'ProcessQueueController@index');

  Route::get('users/', 'admin\UsersController@view');
  Route::post('datatables/users/', 'DatatablesController@users');

  Route::get('proxies/', 'admin\ProxiesController@view');
  Route::post('datatables/proxies/', 'DatatablesController@proxies');

});


Route::group(['middleware' => [/*'CheckForBot',*/ 'CheckInstagramLogin']], function () {

  Route::get('/', 'DashboardController@index');

  Route::get('followers/start', 'FollowController@start');
  Route::get('likes/start', 'LikeController@start');
  Route::get('comments/start', 'CommentController@start');

  Route::post('likes/media', 'LikeController@media');
  Route::post('comments/media', 'CommentController@media');

  Route::get('queue/view', 'QueueController@show');

  Route::post('followers/start', 'FollowController@store');
  Route::post('likes/start', 'LikeController@store');
  Route::post('comments/start', 'CommentController@store');

  Route::post('media/get', 'MediaController@get');

  Route::get('success', 'NotificationController@after_request');


  //logout
  Route::get('logout', 'IPController@logout');

  Route::get('instagram_logout', 'IPController@instagram_logout');

});

Route::get('/home', 'HomeController@index')->name('home');
