<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyBaseController;

use App\Models\User;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

use Illuminate\Http\Request;

class UserController extends MyBaseController
{

	public function getIndex() {
		
		$users = User::all();
		return view("admin/users/index")
			->with("users", $users);
	}

	public function postUsers() {

	}


}
