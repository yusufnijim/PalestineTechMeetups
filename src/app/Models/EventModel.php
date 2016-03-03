<?php

namespace App\Models;


class EventModel extends BaseModel
{
    protected $table = 'event';
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
            'is_registration_open' => $request->is_registration_open,
            'location' => $request->location,
            'date' => $request->date,
            'max_registrars_count' => $request->max_registrars_count,
        ]);
    }

    public static function edit($id, $request)
    {
        return Static::find($id)->update([
            'title' => $request->title,
            'body' => $request->body,
            'is_registration_open' => $request->is_registration_open,
            'location' => $request->location,
            'date' => $request->date,
            'max_registrars_count' => $request->max_registrars_count,
        ]);
    }

}
