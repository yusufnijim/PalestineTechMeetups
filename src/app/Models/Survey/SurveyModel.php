<?php

namespace App\Models\Survey;

use App\Models\BaseModel;

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

    public function questions()
    {
        return $this->hasMany(SurveyQuestionModel::class, 'survey_id', 'id');
    }

//    public static function insert($request)
//    {
//        $instance = static::_handleCreateEdit(new Static(), $request);
//        return $instance;
//    }
//
//    public static function edit($id, $request)
//    {
//        return static::_handleCreateEdit(Static::findOrFail($id), $request);
//    }
//
//    private static function _handleCreateEdit($instance, $request)
//    {
//        $instance->fill([
//            'name' => $request->name,
//            'description' => $request->description2,
//        ]);
//        $instance->save();
//
//        SurveyQuestionModel::insert($request, $instance->id);
//        return $instance;
//    }
}
