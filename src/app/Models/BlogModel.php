<?php

namespace App\Models;


class BlogModel extends BaseModel
{
    protected $table = 'blog';
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

        $instance = static::_handleCreateEdit(new Static(), $request);
        return $instance;
    }

    public static function edit($id, $request)
    {
        $instance = static::_handleCreateEdit(Static::findOrFail($id), $request);
        return $instance;
    }

    private static function _handleCreateEdit($instance, $request)
    {
        $instance->fill([
                'title' => $request->title,

                'permalink' => $request->permalink,
                'body' => $request->body,
                'is_published' => $request->is_published,
            ]
        );
        $instance->save();
        return $instance;
    }


    public function scopePublished($query, $flag = true)
    {
        return $query->where('is_published', $flag);
    }
}
