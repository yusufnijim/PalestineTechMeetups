<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\User\CreateRequest;
use App\Repositories\Contracts\User\UserRepository;


/**
 * contains users functions, registration, login...etc
 */
class UserController extends MyBaseController
{
    use UserSocalLogin;

    protected $user_repo;

    public function __construct(UserRepository $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    public function anyIndex()
    {
        can("user.manage");

        $users = $this->user_repo->all();
        return view('user/index')
            ->with('users', $users);
    }


    public function getCreate()
    {
        can("user.manage");

        $user = $this->user_repo->new();
        return view('/user/create')
            ->with('user', $user);
    }

    public function postCreate(CreateRequest $request)
    {
        can("user.manage");

        UserModel::insert($request);
        flash('user created successfully', 'success');
        return redirect("/user/");
    }

    public function getEdit($id)
    {
        can("user.manage");

        $user = $this->user_repo->find($id);
        return view('/user/edit')
            ->with('user', $user);
    }

    public function putEdit($id, CreateRequest $request)
    {
        can("user.manage") OR auth()->user()->id != $id;

        UserModel::edit($id, $request);
        flash('profile edited successfully', 'success');
        return redirect("/user/edit/$id");
    }


    public function getView($id)
    {
        can("user.manage");

        $user = $this->user_repo->find($id);
        return view('/user/view')
            ->with('user', $user);
    }


    public function getProfile()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return redirect("/user/view/$user->id");
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
            flash('welcome in ' . Auth::user()->username, 'success');
            return redirect('/user/');
        } else {
            flash('unable to login', 'danger');
            return redirect('/user/login');
        }
    }

    public function deleteDelete($id)
    {
        can("user.manage");

        $user = UserModel::find($id)->delete();
        flash('user deleted successfully', 'success');
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
        auth()->logout();
        flash('User logged out successfully', 'success');
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

            flash('welcome back', 'success');
            return redirect('/profile/');
        } else {
            $new_user = UserModel::insert_fb($fb_user_object);

            if ($new_user) {

                flash('Welcome ' . $new_user->first_name . ' Account registered', 'success');
                auth()->login($new_user);
                return redirect('/profile/');
            } else {
                flash('some error occurred', 'danger');
                return redirect('/login');
            }

        }
    }
}