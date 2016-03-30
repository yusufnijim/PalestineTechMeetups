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

    /**
     * return user's full name.
     *
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Return HTML tag for user image
     * @param $value
     * @return string
     */
    public function getImagetagAttribute($value)
    {
        if (!$this->image) {
            $this->image = static::$default_image;
        }

        $value = $this->image;
        $result = "<img class='user_image' src='" . static::$user_images_upload_directory . "$value' />";

        return $result;
    }

    /**
     * return display name for gender, male/female
     * @return int|string
     */
    public function getGenderNameAttribute()
    {
        if ($this->gender == 1) {
            return "Male";
        } elseif ($this->gender == 2) {
            return "Female";
        } else {
            return 1;
        }
    }

//    public function setGenderAttribute($value)
//    {
//        if ($value === "male") {
//            return 1;
//        } elseif ($value === "female") {
//            return 2;
//        } else {
//            return $value;
//        }
//    }

    /**
     *
     * @param $value
     * @return string
     */
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

    /**
     * return user profession name or value.
     * @param null $rev
     * @return array
     */
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


    /**
     * Return events this user registered in.
     * @return $this
     */
    public function events_registered()
    {
        return $this->belongsToMany(\App\Models\EventModel::class, 'event_registration', 'user_id', 'event_id')->withPivot('is_attended');
    }

    /**
     * return events this user volunteered in.
     * @return $this
     */
    public function events_volunteered()
    {
        return $this->belongsToMany(\App\Models\EventModel::class, 'event_volunteer', 'user_id', 'event_id')->withPivot('type_id');
    }

    /**
     * insert new user
     * @param $request
     * @return mixed
     */
    public static function insert($request)
    {
        $instance = static::_handleCreateEdit(new Static(), $request);
        return $instance;
    }

    /**
     * Edit user attributes
     * @param $id
     * @param $request
     * @return mixed
     */
    public static function edit($id, $request)
    {
        $instance = static::_handleCreateEdit(Static::findOrFail($id), $request);
        return $instance;
    }

    /**
     * This function will handle user attributes, creating or editing
     * @param $user
     * @param $request
     * @return mixed
     */
    private static function _handleCreateEdit($user, $request)
    {
        $user->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->location,

            'arabic_full_name' => $request->arabic_full_name,
            'profession' => $request->profession,
            'profession_location' => $request->profession_location,

            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'profession' => $request->profession,
        ]);
        $user->gender = $request->gender;

        $user->save();


        static::_uploadUserImage($user, $request);

        $user->save();
        return $user;
    }

    /**
     * handle user image uploads
     * @param $user
     * @param $request
     * @return mixed
     */
    private static function _uploadUserImage($user, $request)
    {
        $image = $request->file('image');
        if ($image) {
            $original_name = $image->getClientOriginalName();

            $ext = get_extension($original_name);
            if (in_array($ext, static::$user_images_allowed_extensions)) {

                $new_file = $user->id . $request->file('image')->getClientOriginalName();
                $result = $request->file('image')
                    ->move(public_path() . static::$user_images_upload_directory,
                        $new_file
                    );

                $user->image = $new_file;
            } else {
                session()->flash('flash_message', 'unkown image file extension');
            }
        }

        return $user;
    }

    /**
     * insert user from FB login
     * @param $fb_user_object
     * @return static
     */
    public static function insert_fb($fb_user_object)
    {
        $instance = new Static();
        $instance->fill([
            'email' => $fb_user_object->email,
            'first_name' => $fb_user_object->user['name'],
//            'last_name' => $fb_user_object->user['last_name'],

            'fb_id' => $fb_user_object->user['id'],
            'fb_token' => $fb_user_object->token,

//                'image' => $fb_user_object->avatar,
        ]);

        $instance->save();
        return $instance;

    }

    public function accessMediasAll()
    {
        if ($this->hasPermission('blog.edit'))
            return true;
        // return true for access to all medias
    }
}
