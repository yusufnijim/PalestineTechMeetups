<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::get('language/{lang}', 'HomeController@language')->where('lang', '[A-Za-z_-]+');


// admin routes
Route::controller('event', 'EventController');
Route::controller('blog', 'BlogController');

Route::controller('/registration', 'RegistrationController');
Route::controller('/backend', 'BackendController');


Route::controller('/user', 'UserController');
Route::controller('/role', 'RoleController');
Route::controller('/survey', 'SurveyController');


// user routes
Route::get('/login', 'UserController@getLogin');
Route::get('/logout', 'UserController@getLogout');

Route::get('/profile', 'UserController@getProfile');
Route::get('/user/profile', 'UserController@getProfile');

Route::get('facebook', 'UserController@facebook');
Route::get('facebook_callback', 'UserController@facebook_callback');

// front end routes
Route::controller('/', 'HomeController');


/**
 * This function is a small helper like dd() but doesn't actually die
 * @param $var
 */
function d($var)
{
    array_map(function ($x) {
        (new \Illuminate\Support\Debug\Dumper)->dump($x);
    }, func_get_args());

}