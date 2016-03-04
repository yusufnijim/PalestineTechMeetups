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

    private $type = [
        'Speaker',
        'Organizer',
        'Volunteer',
        'Mentor',
    ];


    public function getGenderAttribute($value)
    {
        if ($value == 1) {
            return "Male";
        } elseif ($value == 2) {
            return "Female";
        } else {
            return "not specified";
        }
    }

    public function setGenderAttribute($value)
    {
        if ($value == "male") {
            return 1;
        } elseif ($value == "female") {
            return 2;
        } else {
            return 0;
        }
    }


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
