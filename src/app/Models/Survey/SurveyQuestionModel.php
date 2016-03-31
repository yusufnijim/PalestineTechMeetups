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

    public function type()
    {
//        return $this->belongsToMany(\App\Models\User\RoleModel::class, "permission_role", 'user_id', 'role_id');
        return $this->hasOne(SurveyQuestionTypeModel::class, 'id', 'type_id');
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
