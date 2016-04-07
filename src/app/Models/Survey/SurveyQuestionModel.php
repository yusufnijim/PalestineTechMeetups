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


    public static function insert($request, $survey_id)
    {
        $instance = new Static();

        $instance->survey_id = $survey_id;
        $instance = static::_handleInsertEdit($instance, $request);

        return $instance;
    }


//    public static function edit($id, $request)
//    {
//        $instance = static::_handleCreateEdit(Static::findOrFail($id), $request);
//        return $instance;
//    }

    private static function _handleInsertEdit($instance, $request)
    {
//        d($request->input());
//        dd($instance);
        $instance->fill([
            'question' => "a" . $request->question,
            'type_id' => 1, // $request->type_id,
            'choice' => serialize($request->choice),
        ]);
        $instance->save();

        return $instance;
    }


    public function type() {
        return $this->hasOne(SurveyQuestionTypeModel::class, 'id', 'type_id');
    }
}