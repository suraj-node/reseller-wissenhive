<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::group(['middleware'=>'isResellerLoggedOut'], function(){
	Route::get('/{company_name?}', 'AuthController@index')->name('web.login');
	Route::post('/validate', 'AuthController@login')->name('web.validate');
});



Route::group(['middleware'=>'isResellerLoggedIn', 'prefix'=>'reseller'], function(){

	//DASHBOARD

	Route::get('/dashboard', ['uses'=>'DashboardController@index', 'as'=>'reseller.dashboard']);

	Route::get('/logout', ['uses'=>'AuthController@logout', 'as'=>'reseller.logout']);

	Route::post('/verify-old-password', ['uses'=>'AuthController@verifyPassword', 'as'=>'reseller.verify-old-password']);
	Route::post('/verify-old-password', ['uses'=>'AuthController@verifyPassword', 'as'=>'reseller.forced-logout']);
	Route::get('/forced-logout', ['uses'=>'AuthController@forcedLogout', 'as'=>'reseller.update-user']);

	//USERS

	Route::get('/users', ['uses'=>'UserController@index', 'as'=>'reseller.users']);
	Route::get('/enrollment', ['uses'=>'UserController@enrollment', 'as'=>'reseller.enrollment']);
	Route::post('/add-user', ['uses'=>'UserController@addNewuser', 'as'=>'reseller.add-user']);
	Route::get('/status-update-user/{value}/{id}', ['uses'=>'UserController@updateUserStatus', 'as'=>'reseller.status-update-user']);
});
	
