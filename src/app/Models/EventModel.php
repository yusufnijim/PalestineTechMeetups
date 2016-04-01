<?php

namespace App\Models;

use App\Models\Survey\SurveyModel;

class EventModel extends BaseModel
{
    protected $table = 'event';
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
                'is_published' => $request->is_published ,
                'survey_id' => $request->survey_id ,
            ]
        );
        $instance->save();
        return $instance;
    }

    public function scopePublished($query, $flag = true)
    {
        return $query->where('is_published', $flag);
    }
}
