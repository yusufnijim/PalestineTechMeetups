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
        if (!auth()->user()->hasPermission('users.manage')) {
            abort(403, 'Access denied');
        }
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
        if (!auth()->user()->hasPermission('users.manage')) {
            abort(403, 'Access denied');
        }

        $new_role = RoleModel::insert($request);
        $request->session()->flash('flash_message', 'Role created successfully!');

        return redirect("/role");
    }

    public function deleteIndex(Request $request)
    {
        if (!auth()->user()->hasPermission('users.manage')) {
            abort(403, 'Access denied');
        }

        $id = $request->input('id');
        $role = RoleModel::find($id)->delete();

        $request->session()->flash('flash_message', 'Role deleted successfully!');
        return redirect("/role");
    }


    public function getPermission()
    {

        $roles = RoleModel::all();
        $permissions = PermissionModel::all();
        return view("permission/index")
            ->with("roles", $roles)
            ->with("permissions", $permissions);
    }

    public function postPermission()
    {
        if (!auth()->user()->hasPermission('users.manage')) {
            abort(403, 'Access denied');
        }

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
        $user = UserModel::find($user_id);
//        $user->assignRole('administrator');
        $roles = RoleModel::all();
        return view('role/user')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function postUser($user_id)
    {
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
