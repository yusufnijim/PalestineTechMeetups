<?php

namespace App\Models\User;

use App\Models\User\HasRole;

use App\Models\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class UserModel extends BaseModel implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasRole;
    protected $table = "user";

    static $user_images_upload_directory = '/userimages/';
    static $default_image = 'default.png';
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
        if (!$this->image) {
            $this->image = static::$default_image;
        }

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

    public static function insert($request)
    {

        $user = new Static();
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
        // to use the attribute set method
        $user->profession = $request->profession;


        $image = $request->file('image');
        if ($image) {
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
        }
        $user->save();
        return $user;
    }


    public static function edit($id, $request)
    {

        $user = Static::findOrFail($id);
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
        // to use the attribute set method
        $user->profession = $request->profession;


        $image = $request->file('image');
        if ($image) {
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
        }
        $user->save();
        return $user;
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

    public static function insert_fb($fb_user_object)
    {
        $instance = new Static();
        $instance->fill([
            'email' => $fb_user_object->email,
            'first_name' => $fb_user_object->user['first_name'],
            'last_name' => $fb_user_object->user['last_name'],

            'fb_id' => $fb_user_object->user['id'],
            'fb_token' => $fb_user_object->token,

//                'image' => $fb_user_object->avatar,
        ]);

        $instance->save();
        return $instance;

    }
}

function get_extension($file)
{
    $file_array = explode(".", $file);
    $extension = end($file_array);

    return $extension ? $extension : false;
}
