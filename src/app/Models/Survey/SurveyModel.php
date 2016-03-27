<?php

namespace App\Models\Survey;


class SurveyModel extends BaseModel
{
    protected $table = 'survey';
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
        return Static::create([
            'title' => $request->title,
            'body' => $request->body,
            'is_published' => $request->is_published,
        ]);
    }

    public static function edit($id, $request)
    {
        return Static::find($id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'is_published' => $request->is_published,
        ]);
    }

}