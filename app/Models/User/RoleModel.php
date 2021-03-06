<?php

namespace App\Models\User;

use App\Models\BaseModel;

class RoleModel extends BaseModel
{
    protected $table = 'role';

    public static function insert($request)
    {
        $role = new static();
        $role->create([
            'name'        => $request->input('name'),
            'label'       => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return $role;
    }

    /**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(PermissionModel::class, 'permission_role', 'role_id', 'permission_id');
    }

    /**
     * Grant the given permission to a role.
     *
     * @param Permission $permission
     *
     * @return mixed
     */
    public function givePermissionTo($permission, $save = true)
    {
        // if passed a permission name, get the permission model
        if (is_string($permission)) {
            $permission = PermissionModel::whereName($permission)->first();
            if (!$permission) {
                return false;
            }
        }

        // if role already has the permission, return true.
        if ($save and $this->permissions()->find([$permission->id])->count()) {
            return $permission;
        }

        if ($save) {
            // assign the permission to this role
            return $this->permissions()->save($permission);
        } else {
            return $this->permissions()->detach($permission);
        }
    }

    public function revokePermissionFrom($permission, $save = false)
    {
        $this->givePermissionTo($permission, $save);
    }
}
