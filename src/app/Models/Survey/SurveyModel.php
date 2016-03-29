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
//        return $this->belongsToMany(\App\Models\User\RoleModel::class, "permission_role", 'user_id', 'role_id');
        return $this->hasMany(SurveyQuestionModel::class, 'survey_id', 'id');
    }

    public static function insert($request)
    {
//        dd($request->input());
        return Static::create([
            'name' => $request->name,
            'description' => $request->description2,
        ]);
    }

    public static function edit($id, $request)
    {
        return Static::findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description2,
        ]);
    }

}
