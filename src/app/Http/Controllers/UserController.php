<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\UserModel;
use App\Http\Requests\User\CreateRequest;


/**
 * contains users functions, registration, login...etc
 */
class UserController extends MyBaseController
{

    use UserSocalLogin;

    public function anyIndex()
    {
        $users = UserModel::all();
        return view('user/index')
            ->with('users', $users);
    }

    public function getEdit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('/user/view')
            ->with('user', $user);
    }

    public function putEdit($id, CreateRequest $request)
    {
        UserModel::edit($id, $request);
        session()->flash('flash_message', 'Profile updated successfully');
        return redirect("/user/edit/$id");
    }

    public function getProfile()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return redirect("/user/edit/$user->id");
        } else {
            abort(404);
        }
    }

    public function getLogin()
    {
        return view('user/login');
    }

    public function postLogin()
    {
        $credentials = \Input::only('email', 'password');
        $user = UserModel::where('email', \Input::get('email'))->first();
        // dd($user);

        if ($user AND \Hash::check(
                \Input::get('password'), $user->password
            )
        ) {
            Auth::login($user);
            session()->flash('flash_message', 'welcome in ' . Auth::user()->username);
            return redirect('/user/');
        } else {
            session()->flash('flash_message', 'Unable to login!');
            return redirect('/user/login');
        }
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function getRegister()
    {
        return redirect('/user/login');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */

    public function anyLogout()
    {
        session()->flash('flash_message', 'User logged out successfully');
        Auth::logout();
        return redirect('/login');
    }
}


trait UserSocalLogin
{

    public function facebook()
    {
        return \Socialite::with('facebook')->redirect();
    }

    public function facebook_callback()
    {
        $fb_user_object = \Socialite::with('facebook')->user();
        $user = UserModel::where('fb_id', $fb_user_object->user['id'])
            ->first();
        // dd($fb_user_object);
        // dd($user);

        if ($user) {
            auth()->login($user);
            session()->flash('flash_message', 'welcome back ' . $user->first_name);
            return redirect('/user/index');
        } else {
            $new_user = new UserModel();

            $new_user->fill([
                'email' => $fb_user_object->email,
                'first_name' => $fb_user_object->user['first_name'],
                'last_name' => $fb_user_object->user['last_name'],

                'fb_id' => $fb_user_object->user['id'],
                'fb_token' => $fb_user_object->token,

//                'image' => $fb_user_object->avatar,
            ]);

            $new_user->save();

            if ($new_user) {
                session()->flash('flash_message', 'Welcome ' . $new_user->first_name . ' Account registered');
                auth()->login($new_user);
                return redirect('/user');
            } else {
                session()->flash('flash_message', 'some error occured');
                return redirect('/login');
            }

        }
    }
}