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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/deploy', 'Maintenance@deploy');
Route::auth();

/*Route::get('/home', 'HomeController@index');*/

Route::get('/', 'HomeController@index');

Route::get('gallery', 'HomeController@gallery');

Route::get('events', 'HomeController@events');

Route::get('recruitment', 'HomeController@recruitment');

Route::get('members', 'HomeController@members');

Route::get('alumni', 'HomeController@alumni');

Route::get('contact', 'HomeController@contact');

Route::get('login', 'HomeController@login');

