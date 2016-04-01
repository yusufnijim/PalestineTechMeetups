<?php

namespace App\Models\Survey;

use App\Models\BaseModel;

class SurveyQuestionModel extends BaseModel
{
    protected $table = 'survey_question';
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


    public static function insert($request)
    {
        $instance = static::_handleInsertEdit(new Static(), $request);
        return $instance;
    }


//    public static function edit($id, $request)
//    {
//        $instance = static::_handleCreateEdit(Static::findOrFail($id), $request);
//        return $instance;
//    }

    private static function _handleInsertEdit($instance, $request)
    {

        return $instance;
    }
}