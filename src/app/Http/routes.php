<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

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

Route::group(['middleware' => ['web']], function () {


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
    Route::get('/', 'HomeController@anyIndex');

});

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