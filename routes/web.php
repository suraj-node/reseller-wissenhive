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
	
	Route::get('/forced-logout', ['uses'=>'AuthController@forcedLogout', 'as'=>'reseller.forced-logout']);
	Route::get('/notifications', ['uses'=>'AuthController@notifications', 'as'=>'reseller.notifications']);

	//USERS

	Route::get('/users', ['uses'=>'UserController@index', 'as'=>'reseller.users']);
	Route::get('/enrollment', ['uses'=>'UserController@enrollment', 'as'=>'reseller.enrollment']);
	Route::post('/add-user', ['uses'=>'UserController@addNewuser', 'as'=>'reseller.add-user']);
	Route::post('/update-user', ['uses'=>'UserController@updateStudent', 'as'=>'reseller.update-user']);
	Route::get('/status-update-user/{value}/{id}', ['uses'=>'UserController@updateUserStatus', 'as'=>'reseller.status-update-user']);
	
	//ENROLLMENT

	Route::get('/enrollment', ['uses'=>'EnrollmentController@index', 'as'=>'reseller.enrollment']);
	Route::get('/get-course', ['uses'=>'EnrollmentController@getCourse', 'as'=>'reseller.get-coursebytype']);
	Route::get('/get-schedule', ['uses'=>'EnrollmentController@getSchedule', 'as'=>'reseller.get-schedulebytype']);
	Route::get('/get-amount', ['uses'=>'EnrollmentController@getAmount', 'as'=>'reseller.get-amountbytype']);
	Route::post('/assign-course', ['uses'=>'EnrollmentController@assignCourse', 'as'=>'reseller.assign-course']);
	Route::get('/affiliate-report', ['uses'=>'EnrollmentController@affiliateReport', 'as'=>'reseller.affiliate-report']);
	
	//COURSE
	Route::get('/course', ['uses'=>'CourseController@index', 'as'=>'reseller.courses']);	
	Route::post('/send-invoice', ['uses'=>'CourseController@sendInvoice', 'as'=>'reseller.send-invoice']);

});


//Admin Routes

Route::group(['namespace'=>'Admin', 'prefix'=>'pinnacle-admin'], function(){
	
	Route::group(['middleware'=>'isAdminLoggedOut'], function(){
		Route::get('/', ['uses'=>'AuthController@index', 'as'=>'reseller.admin']);
		Route::post('/admin-authentication', ['uses'=>'AuthController@validateAdmin', 'as'=>'reseller.admin-authentication']);
	});

	Route::group(['middleware'=>'isAdminLoggedIn'], function(){
		
		Route::get('/dashboard', ['uses'=>'HomeController@index', 'as'=>'reseller.admin-dashboard']);
		Route::get('/admin-logout', ['uses'=>'HomeController@forcedLogout', 'as'=>'reseller.admin-logout']);
		Route::get('/resellers', ['uses'=>'HomeController@resellers', 'as'=>'reseller.admin-resellers']);
		Route::get('/reseller-remove/{reseller_id}', ['uses'=>'HomeController@resellerRemove', 'as'=>'reseller.admin-reseller-remove']);
		Route::get('/reseller-students/{reseller_id}', ['uses'=>'HomeController@resellerStudents', 'as'=>'reseller.admin-reseller-students']);

		//RESELLER URL

		Route::get('/reseller-add', ['uses'=>'ResellerController@add', 'as'=>'reseller.admin-reseller-add']);
		Route::post('/reseller-add-make', ['uses'=>'ResellerController@addMake', 'as'=>'reseller.admin-reseller-add-make']);
		Route::get('/reseller-edit/{reseller_id}', ['uses'=>'ResellerController@getResellerInfo', 'as'=>'reseller.admin-reseller-edit']);
		Route::post('/reseller-edit-make', ['uses'=>'ResellerController@editMake', 'as'=>'reseller.admin-reseller-edit-make']);

		Route::get('/reseller-change-password/{reseller_id}', ['uses'=>'ResellerController@changePassword', 'as'=>'reseller.admin-reseller-change']);
		Route::post('/reseller-change-password-make', ['uses'=>'ResellerController@changePasswordMake', 'as'=>'reseller.admin-reseller-change-make']);
		
		//Admin ROUTES

		Route::get('/admin', ['uses'=>'AdminController@index', 'as'=>'reseller.admin-home']);
		Route::get('/admin/remove/{admin_id}', ['uses'=>'AdminController@removeAdmin', 'as'=>'reseller.admin-remove']);
		Route::get('/admin/change-password/{admin_id}', ['uses'=>'AdminController@changePassword', 'as'=>'reseller.admin-change-password']);
		Route::post('/reseller-admin-change-password-make', ['uses'=>'AdminController@changePasswordMake', 'as'=>'reseller.admin-change-make']);
		Route::get('/reseller-add-admin', ['uses'=>'AdminController@add', 'as'=>'reseller.admin-add']);
		Route::post('/reseller-add-admin-make', ['uses'=>'AdminController@addMake', 'as'=>'reseller.admin-admin-add-make']);
		Route::get('/reseller-edit-admin/{admin_id}', ['uses'=>'AdminController@AdminInfo', 'as'=>'reseller.admin-edit']);
		Route::post('/reseller-edit-admin-make', ['uses'=>'AdminController@editMakeAdmin', 'as'=>'reseller.admin-edit-make']);


		//COURSE ROUTES
		Route::get('/course', ['uses'=>'CourseController@index', 'as'=>'reseller.course']);
		Route::get('/course/remove/{course_id}', ['uses'=>'CourseController@removeCourse', 'as'=>'reseller.course-remove']);
		Route::get('/course/add', ['uses'=>'CourseController@add', 'as'=>'reseller.course-add']);
		Route::post('/course/add-make', ['uses'=>'CourseController@addMake', 'as'=>'reseller.course-add-make']);
		Route::get('/course/{course_id}', ['uses'=>'CourseController@CourseInfo', 'as'=>'reseller.course-edit']);
		Route::post('/course/edit-make', ['uses'=>'CourseController@editMake', 'as'=>'reseller.course-edit-make']);


		//STUDENTS ROUTES
		Route::post('/add-user', ['uses'=>'StudentController@addNewuser', 'as'=>'reseller.admin-add-user']);
		Route::post('/update-user', ['uses'=>'StudentController@updateStudent', 'as'=>'reseller.admin-update-user']);
		Route::get('/invoice', ['uses'=>'StudentController@invoice', 'as'=>'reseller.admin-invoice']);
		Route::post('/updateinvoice', ['uses'=>'StudentController@updateInvoice', 'as'=>'reseller.admin-invoice-update']);
		Route::get('/remove/{invoice_id}', ['uses'=>'StudentController@remove', 'as'=>'reseller.admin-invoice-remove']);

		Route::get('/enrollment-notificatitons', ['uses'=>'StudentController@enrollmentNotifications', 'as'=>'reseller.admin-enrollment-notifications']);
	});
	
});



	
