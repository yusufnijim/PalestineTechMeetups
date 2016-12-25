<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BlogModel;

class EventImageModel extends BaseModel
{
    protected $table = 'events_images';

    public static $default_image = 'default.png';
    public static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];
    public static $image_upload_directory = '/image/event/';

    public function blog()
    {
        return $this->hasMany('App\Models\BlogModel', 'blog_id', 'id');
    }
}
