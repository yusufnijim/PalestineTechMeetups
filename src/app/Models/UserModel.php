<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;


class UserModel extends Authenticatable implements HasRoleAndPermissionContract
{
    use HasRoleAndPermission;

    protected $table = "users";
    static $user_images_upload_directory = '/userimages/';
    static $user_images_allowed_extensions = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    protected $guarded = [];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getImagetagAttribute($value)
    {
        $value = $this->image;
        $result = "<img class='user_image' src='" . static::$user_images_upload_directory . "$value' />";

        return $result;
    }


    public function getGenderAttribute($value)
    {
        if ($value == 1) {
            return "Male";
        } elseif ($value == 2) {
            return "Female";
        } else {
            return "not specified";
        }
    }

    public function setGenderAttribute($value)
    {
        if ($value == "male") {
            return 1;
        } elseif ($value == "female") {
            return 2;
        } else {
            return 0;
        }
    }

    public function getProfessionAttribute($value)
    {
        if ($value == 1) {
            return "student";
        } elseif ($value == 2) {
            return "employed";
        } elseif ($value == 3) {
            return "unemployed";
        } else {
            return $value;
        }
    }

    public function setProfessionAttribute($value)
    {
        if ($value == "student") {
            return 1;
        } elseif ($value == "Employed") {
            return 2;
        } elseif ($value == "Unemployed") {
            return 3;
        } else {
            return $value;
        }
    }

    public static function edit($id, $request)
    {

        $user = Static::find($id)->first();

        $user->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->location,

            'arabic_full_name' => $request->arabic_full_name,
            'profession' => $request->profession,
            'profession_location' => $request->profession_location,

            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
        ]);


        $user->profession = $request->profession;


        $image = $request->file('image');
        $original_name = $image->getClientOriginalName();

        $ext = get_extension($original_name);
        if (in_array($ext, static::$user_images_allowed_extensions)) {

            $new_file = $id . $request->file('image')->getClientOriginalName();
            $result = $request->file('image')
                ->move(public_path() . static::$user_images_upload_directory,
                    $new_file
                );

            $user->image = $new_file;
        } else {
            session()->flash('flash_message', 'unkown image file extension');
        }

        $user->save();

        return $user;
    }


    public function test() {

    }



    public static function professions($rev = NULL)
    {
        $array = [
            1 => 'student',
            2 => 'employed',
            3 => 'unemployed',
        ];
        if ($rev) {
            return array_flip($array);
        } else {
            return $array;
        }
    }
}

function get_extension($file)
{
    $file_array = explode(".", $file);
    $extension = end($file_array);

    return $extension ? $extension : false;
}