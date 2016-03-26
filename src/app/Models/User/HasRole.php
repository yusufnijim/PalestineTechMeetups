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
    public function assignRole($role)
    {
        // if we passed a role name, find it
        if (is_string($role)) {
            $role = RoleModel::whereName($role)->first();
        }


        // if user already has the role, return true.
        if (($this->roles()->find([$role->id])->count())) {
            return $role;
        }

        // assign role
        return $this->roles()->save(($role));
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
        return !!$role->intersect($this->roles)->count();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        // WARNING: skip permissions check in development mode
        if (config('app.debug')) {
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