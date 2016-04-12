<?php

namespace App\Models\Event;

use App\Models\Survey\SurveyModel;
use App\Models\BaseModel;

class EventModel extends BaseModel
{
    protected $table = 'event';
    static $image_upload_directory = '/image/event/';
    static $default_image = 'default.png';
    static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];

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

    public function survey()
    {
        return $this->hasOne(SurveyModel::class, 'id', 'survey_id');
    }

    public static function insert($request)
    {
        $instance = static::_handleCreateEdit(new Static(), $request);
        return $instance;
    }

    public static function edit($id, $request)
    {
        $instance = static::_handleCreateEdit(Static::findOrFail($id), $request);
        return $instance;
    }


    private static function _handleCreateEdit($instance, $request)
    {
        $instance->fill([
                'title' => $request->title,
                'body' => $request->body,
                'permalink' => $request->permalink,
                'is_registration_open' => $request->is_registration_open,
                'max_registrars_count' => $request->max_registrars_count,
                'location' => $request->location,
                'date' => $request->date,
                'require_additional_fields' => $request->max_registrars_count,
                'is_published' => $request->is_published,
                'survey_id' => $request->survey_id,
            ]
        );
        static::_uploadImage($instance, $request, 'featured_image');

        $instance->save();
        return $instance;
    }


    /**
     * handle user image uploads
     * @param $user
     * @param $request
     * @return mixed
     */
    private static function _uploadImage($instance, $request, $name)
    {
        $image = $request->file($name);
        if ($image) {
            $original_name = $image->getClientOriginalName();

            $ext = get_extension($original_name);
            if (in_array($ext, static::$image_allowed_extension)) {

                $new_file = $instance->id . $request->file($name)->getClientOriginalName();
                $result = $request->file($name)
                    ->move(public_path() . static::$image_upload_directory,
                        $new_file
                    );

                $instance->$name = $new_file;
            } else {
                session()->flash('flash_message', 'unkown image file extension');
            }
        } else {
        }

        return $instance;
    }

    public function getSummaryAttribute($value)
    {
        $summary = substr($this->body, 0, 500);
        return $summary;
    }

    public function scopePublished($query, $flag = true)
    {
        return $query->where('is_published', $flag);
    }

    /**
     * Return HTML tag for user image
     * @param $value
     * @return string
     */
    public function getFeaturedimagetagAttribute($value)
    {
        if (!isset($this->featured_image)) {
            $this->featured_image = static::$default_image;
        }

        $value = $this->featured_image;
        $result = "<img class='image event-image' src='" . static::$image_upload_directory . "$value' />";

        return $result;
    }

}
