<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyBaseController;

use App\Models\User;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;


use Illuminate\Http\Request;

class MainController extends MyBaseController
{
	public function anyIndex() {
		return view("admin/index");
	}


}
