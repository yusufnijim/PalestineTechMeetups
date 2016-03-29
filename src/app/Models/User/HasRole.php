<?php

namespace App\Models\User;


trait HasRole
{
    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignRole($role, $save = true)
    {
        // if we passed a role name, find it
        if (is_string($role)) {
            $role = RoleModel::whereName($role)->first();
        }

        // if user already has the role, return true.
        if ($save AND ($this->roles()->find([$role->id])->count())) {
            return $role;
        }

        // assign role
        if ($save) {
            return $this->roles()->save(($role));
        } else {
            return $this->roles()->detach(($role));
        }
    }

    public function revokeRole($role, $save = false)
    {
        return $this->assignRole($role, $save);
    }


    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
//        dd($role->name);
        return $this->roles()->find([$role->id])->count();
//        return !!$role->intersect($this->roles)->count();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        // WARNING: skip permissions check, for use in development mode ONLY
        if (env('SKIP_PERMISSION_CHECK')) {
            return TRUE;
        };

        // if passed a permission name, find it
        if (is_string($permission)) {
            $permission = PermissionModel::whereName($permission)->first();
            if (!$permission) {
                return False;
            }
        }

        // does user have roles with this permission
        return $this->hasRole($permission->roles);
    }
}