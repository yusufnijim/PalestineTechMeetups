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
        $instance = static::_handleCreateEdit(new Static(), $request);
    }

    public static function edit($id, $request)
    {
        return static::_handleCreateEdit(Static::findOrFail($id), $request);
    }

    private static function _handleCreateEdit($instance, $request)
    {
        $instance->fill([
            'name' => $request->name,
            'description' => $request->description2,
        ]);
        $instance->save();

        return $instance;
    }
}
