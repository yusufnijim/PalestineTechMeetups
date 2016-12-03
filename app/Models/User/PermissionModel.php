<?php

namespace App\Models\User;

use App\Models\BaseModel;

class PermissionModel extends BaseModel
{
    protected $table = 'permission';

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        //        return $this->belongsToMany(\App\Models\User\RoleModel::class, "permission_role", 'user_id', 'role_id');
        return $this->belongsToMany(RoleModel::class, 'permission_role', 'permission_id', 'role_id');
    }
}
