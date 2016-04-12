<?php

namespace App\Models\Event;
use App\Models\BaseModel;

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

    public static $type = [
        0 => 'Speaker',
        1 => 'Organizer',
        2 => 'Volunteer',
        3 => 'Mentor',
    ];


    public function getTypeAttribute($value)
    {
        return static::$type[$this->type_id];
    }

    protected $guarded = [];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne UserModel
     */
    public function user()
    {
        return $this->hasOne('App\Models\User\UserModel', 'id', 'user_id');
    }

    /**
     * add user as a volunteer to event
     * @param $event_id
     * @return static
     */
//    public static function insert($event_id)
//    {
//        $instance = Static::firstOrCreate($values_array);
//        return $instance;
//    }
}
