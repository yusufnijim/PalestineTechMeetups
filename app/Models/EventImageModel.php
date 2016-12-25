<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event\EventModel;

class EventImageModel extends BaseModel
{
    protected $table = 'events_images';

    public static $default_image = 'default.png';
    public static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];
    public static $image_upload_directory = '/image/event /';

    public function event()
    {
        return $this->hasMany('App\Models\Event\EventModel', 'event_id', 'id');
    }
}
