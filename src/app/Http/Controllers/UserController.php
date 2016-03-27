<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User\UserModel;
use App\Http\Requests\User\CreateRequest;


/**
 * contains users functions, registration, login...etc
 */
class UserController extends MyBaseController
{

    use UserSocalLogin;

    public function anyIndex()
    {
        if (!auth()->user()->hasPermission('users.manage')) {
            abort(403, 'Access denied');
        }

        $users = UserModel::all();
        return view('user/index')
            ->with('users', $users);
    }

    public function getEdit($id)
    {
        if (auth()->user()->id != $id) {
            if (!auth()->user()->hasPermission('users.manage')) {
                abort(403, 'Access denied');
            }
        }

        $user = UserModel::findOrFail($id);
        return view('/user/view')
            ->with('user', $user);
    }

    public function putEdit($id, CreateRequest $request)
    {
        if (auth()->user()->id != $id) {
            if (!auth()->user()->hasPermission('users.manage')) {
                abort(403, 'Access denied');
            }
        }
        UserModel::edit($id, $request);
        session()->flash('flash_message', 'Profile updated successfully');
        return redirect("/user/edit/$id");
    }


    public function putView($id, CreateRequest $request)
    {
        if (auth()->user()->id != $id) {
            if (!auth()->user()->hasPermission('users.manage')) {
                abort(403, 'Access denied');
            }
        }
        UserModel::edit($id, $request);
        session()->flash('flash_message', 'Profile updated successfully');
        return redirect("/user/edit/$id");
    }
    public function getCreate()
    {
        if (!auth()->user()->hasPermission('users.manage')) {
            abort(403, 'Access denied');
        }

        $user = new UserModel();
        return view('/user/create')
            ->with('user', $user);
    }

    public function putCreate(CreateRequest $request)
    {
        if (!auth()->user()->hasPermission('users.manage')) {
            abort(403, 'Access denied');
        }

        UserModel::insert($request);
        session()->flash('flash_message', 'Profile updated successfully');
        return redirect("/user/");
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

    public function deleteDelete($id) {
        $user = UserModel::find($id)->delete();
        return redirect("/user");
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
        auth()->logout();
        return redirect('/login');
    }
}


trait UserSocalLogin
{

    /**
     * This function will redirect the user to facebook login
     * @return mixed
     */
    public function facebook()
    {
        return \Socialite::with('facebook')->redirect();
    }

    /**
     * this function will handle social login with facebook using socialite package
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function facebook_callback()
    {
        $fb_user_object = \Socialite::with('facebook')->user();
        $user = UserModel::where('fb_id', $fb_user_object->user['id'])
            ->first();

        if ($user) {
            auth()->login($user);
            session()->flash('flash_message', 'welcome back ' . $user->first_name);
            return redirect('/profile/');
        } else {
            $new_user = UserModel::insert_fb($fb_user_object);

            if ($new_user) {
                session()->flash('flash_message', 'Welcome ' . $new_user->first_name . ' Account registered');
                auth()->login($new_user);
                return redirect('/profile/');
            } else {
                session()->flash('flash_message', 'some error occurred');
                return redirect('/login');
            }

        }
    }
}