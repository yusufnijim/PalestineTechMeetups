<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyBaseController;

use App\Models\User;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

use Illuminate\Http\Request;

class RoleController extends MyBaseController
{

	public function getIndex(Request $request) {

		$roles = Role::all();
		return view("admin/roles")->with("roles", $roles);
	}

	public function postIndex(Request $request) {

		
		$new_role = Role::create([
		    'name' => $request->input('name'),
		    'slug' => $request->input('name'),
		    'description' => $request->input('description'),
		    'level' => 1, // optional, set to 1 by default
		]);
		$request->session()->flash('flash_message', 'Role created successfully!');

		return redirect("/admin/role");
	}

	public function deleteIndex(Request $request) {

		$id = $request->input('id');

		$role = Role::find($id);
		$role->delete();

		$request->session()->flash('flash_message', 'Role deleted successfully!');
		return redirect("/admin/role");
	}





	public function getPermissions() {
		
		$roles = Role::all();
		$permissions = Permission::all();
		return view("admin/permissions")
			->with("roles", $roles)
			->with("permissions", $permissions);
	}

	public function postPermissions() {

	}

}
