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
use App\Models\UserModel;

//$user = UserModel::findOrNew(1);
//Auth::login($user);

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
$result = DB::query("select true");

Route::group(['middleware' => ['web']], function () {

    Route::controller('user', 'UserController');
    Route::get('/profile', 'UserController@getProfile');
    Route::get('/user/profile', 'UserController@getProfile');


    Route::controller('event', 'EventController');
    Route::controller('blog', 'BlogController');

    Route::controller('/registration', 'RegistrationController');


    Route::group(['prefix' => '/admin'], function () {

        Route::controller('/user/', 'Admin\UserController');
        Route::controller('/role/', 'Admin\RoleController');
        Route::controller('/', 'Admin\MainController');
    });


    Route::get('/', 'EventController@anyIndex');


    Route::get('logout', function () {
        session()->flash('flash_message', 'User logged out successfully');
        Auth::logout();
        return redirect('/');
    });

    Route::get('facebook', 'UserController@facebook');
    Route::get('facebook_callback', 'UserController@facebook_callback');

});


function d($var)
{
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}