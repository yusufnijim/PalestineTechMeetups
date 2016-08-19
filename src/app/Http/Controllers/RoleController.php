<?php

namespace App\Http\Controllers;


use App\Models\User\UserModel;
use App\Models\User\RoleModel;
use App\Models\User\PermissionModel;

use Illuminate\Http\Request;

class RoleController extends MyBaseController
{
    /**
     * Get all roles, index page
     * @param Request $request
     * @return $this
     */
    public function getIndex(Request $request)
    {
        can("user.manage");

        $roles = RoleModel::all();
        return view("role/index")->with("roles", $roles);
    }

    /**
     * This page will create the role if validation passes, then redirect back to index page.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postIndex(Request $request)
    {
        can("user.manage");

        $new_role = RoleModel::insert($request);
        flash('Role created successfully!', 'success');

        return redirect("/role");
    }

    public function deleteIndex(Request $request)
    {
        can("user.manage");

        $id = $request->input('id');
        $role = RoleModel::find($id)->delete();

        flash('Role deleted successfully!', 'success');
        return redirect("/role");
    }


    public function getPermission()
    {
        can("user.manage");

        $roles = RoleModel::all();
        $permissions = PermissionModel::all();
        return view("permission/index")
            ->with("roles", $roles)
            ->with("permissions", $permissions);
    }

    public function postPermission()
    {
        can("user.manage");

        $role = RoleModel::find(request()->input()['role_id']);
        $permission = PermissionModel::find(request()->input()['permission_id']);


        if ($role->permissions()->find([$permission->id])->count()) {
            $save = false;
        } else {
            $save = true;
        }

        $role->givePermissionTo($permission, $save);
        return redirect('/role/permission');
    }

    public function getUser($user_id)
    {
        can("user.manage");

        $user = UserModel::find($user_id);
//        $user->assignRole('administrator');
        $roles = RoleModel::all();
        return view('role/user')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function postUser($user_id)
    {
        can("user.manage");

        $user = UserModel::find($user_id);
        $role = RoleModel::find(request()->role_id);

        if ($user->hasRole($role)) {
            $user->revokeRole($role);
        } else {
            $user->assignRole($role);
        }
        return redirect('role/user/' . $user_id);
    }
}
