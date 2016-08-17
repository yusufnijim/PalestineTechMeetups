<?php

namespace App\Models\Survey;

use App\Models\BaseModel;
use App\Models\User\UserModel;

class SurveySubmissionModel extends BaseModel
{
    protected $table = 'survey_submission';
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


    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'id');
    }


    public function answers()
    {
        return $this->hasMany(SurveyQuestionAnswerModel::class, 'submission_id', 'id');
    }

    public static function insert($request, $survey_id)
    {

    }

}