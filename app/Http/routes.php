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

// Note: Middleware to be applied on controller in __construct(), not routes level ~MD
// All routes in this file have the 'Web' middleware applied, and is not designed for RESTful APIs
// 		refer to app/Providers/RouteServiceProvider to manage default route middleware




/* +--------------------------------------+
   | Public/Home Routes                   |
   +--------------------------------------+
*/


Route::get('/', 			'HomeController@index');
Route::get('gallery', 		'HomeController@gallery');
Route::get('events', 		'HomeController@events');
Route::get('recruitment', 	'HomeController@recruitment');
Route::get('recruitment/signup', 	'HomeController@recruitmentSignUp');
Route::post('recruitment/signup', 	'RecruitmentController@store');
Route::get('members', 		'HomeController@members');
Route::get('members/{user}', 'HomeController@profile');
Route::get('alumni', 		'HomeController@alumni');
Route::get('contact', 		'HomeController@contact');

Route::get('profile',			'HomeController@profile');

Route::get('gallery/{album}', 		'HomeController@retrieveImagesByAlbum');
Route::get('createEvent', 'EventsController@createEvent');


Route::get('events/{event}', 'HomeController@retrieveIndividualEvent');
Route::get('events/{event}/attendance', 'EventsController@takeAttendance');
Route::post('events/{event}/attendance', 'EventsController@saveAttendance');
Route::get('events/edit/{event}', 'EventsController@editEvent');

Route::get('editProfile/{user}', 'ProfileController@editProfile');

Route::get('editProfile', 'ProfileController@editMyProfile');






/* +--------------------------------------+
   | Private/User Routes                  |
   +--------------------------------------+
*/
//Patch Routes
Route::patch('editProfile/{user}', 'ProfileController@update');
Route::patch('events/edit/{event}', 'EventsController@update');



// =============== Admin Panel ===============

Route::get('/admin/recruitment',      'AdminController@recruitmentList');

Route::get('admin',                'AdminController@showPanel');

Route::get('admin/new/class',      'AdminController@newClassForm');
Route::post('admin/new/class',     'AdminController@newClassSubmit');

Route::get('admin/new/semester',      'AdminController@newSemesterForm');
Route::post('admin/new/semester',     'AdminController@newSemesterSubmit');

Route::get('admin/edit/brothers',   'AdminController@manageBrothersForm');
Route::get('admin/attendance', 'AdminController@getAttendanceSheet');



// ============= End Admin Panel =============



//Post routes
Route::post('createEvent', 'EventsController@store');
Route::post('editProfile', 'ProfileController@store');
Route::post('gallery', 'GalleryController@storeAlbum');
Route::post('gallery/{album}', 'GalleryController@storeImage');

/* +--------------------------------------+
   | USER AUTHORIZATION ROUTES            |
   +--------------------------------------+
*/

// ============ START USER AUTH =================
   //modified from vendor/laravel/framework/src/Illuminate/Routing/Router.php ~MD
   //Route::auth();

   // Login Routes
   Route::get('login', 'Auth\AuthController@showLoginForm');
   Route::post('login', 'Auth\AuthController@login');
   Route::get('logout', 'Auth\AuthController@logout');

   // Registration Routes...
   Route::get('register','Auth\AuthController@showTokenError');// added to support token
   Route::get('register/{registration_token}', 'Auth\AuthController@showRegistrationForm');
   Route::post('register', 'Auth\AuthController@register');

   // Password Reset Routes...
   Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
   Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
   Route::post('password/reset', 'Auth\PasswordController@reset');

// ============ END USER AUTH =================


Route::get('/linkedin',
	'Auth\SocialMediaController@LinkedInRedirectToProvider');
Route::get('/linkedin/callback',
	'Auth\SocialMediaController@LinkedInHandleProviderCallback');




/* +--------------------------------------+
   | Maintenance Routes                   |
   +--------------------------------------+
*/

Route::get('/deploy', 'Maintenance@deploy');
