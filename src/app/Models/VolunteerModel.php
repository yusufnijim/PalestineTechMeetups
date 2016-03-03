<?php

namespace App\Models;


class VolunteerModel extends BaseModel
{
    protected $table = 'event_volunteer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    // ];

    protected $guarded = [];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function user()
    {
        return $this->hasOne('App\Models\UserModel', 'id', 'user_id');
    }
}
