<?php

namespace App\Models\Survey;

use App\Models\BaseModel;

class SurveyQuestionTypeModel extends BaseModel
{
    protected $table = 'survey_question_type';
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
        return static::create([
            'title'        => $request->title,
            'body'         => $request->body,
            'is_published' => $request->is_published,
        ]);
    }

    public static function edit($id, $request)
    {
        return static::find($id)->update([
            'title'        => $request->title,
            'body'         => $request->body,
            'is_published' => $request->is_published,
        ]);
    }
}
