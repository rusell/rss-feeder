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

// ===================================================  AUTH  =================================================== \\
Route::get('/', 'AuthController@index')->name('home');
Route::get('login', 'AuthController@showLoginForm')->name('login');
Route::get('register', 'AuthController@showRegistrationForm')->name('register');
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout')->name('logout');
Route::post('lookup-email', 'AuthController@lookupEmailAddress');
// ============================================================================================================== \\

// ==============================================  AUTHORIZED  ================================================== \\
Route::group(['middleware' => ['auth']], function () {
	Route::get('/feeds', 'FeedController@index');
});
// ============================================================================================================== \\
