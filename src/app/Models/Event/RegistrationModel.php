<?php

namespace App\Models\Event;

use App\Models\BaseModel;
class RegistrationModel extends BaseModel
{
    protected $table = 'event_registration';
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
        return $this->hasOne('App\Models\User\UserModel', 'id', 'user_id');
    }


}
