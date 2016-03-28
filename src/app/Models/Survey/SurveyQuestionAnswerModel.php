<?php

namespace App\Models\Survey;

use App\Models\BaseModel;

class SurveyQuestionAnswerModel extends BaseModel
{
    protected $table = 'survey_question_answer';
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

    public static function insert($survey_id, $request)
    {
        $user_id = auth()->check() ? auth()->user()->id : 0;

        foreach ($request['answer'] as $question_id => $answer) {
            $instance = Static::create([
                'survey_id' => $survey_id,
                'question_id' => $question_id,
                'answer' => $answer,
                'user_id' => $user_id,
            ]);
        }

        return true;
    }

//    public static function edit($id, $request)
//    {
//        return Static::find($id)->update([
//            'title' => $request->title,
//            'body' => $request->body,
//            'is_published' => $request->is_published,
//        ]);
//    }

}
