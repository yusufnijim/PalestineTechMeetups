<?php

namespace App\Repositories\Eloquent\User;

use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\Eloquent\BaseRepositoryEloquent;
use App\Repositories\Contracts\User\UserRepository;
use App\Models\User\UserModel;

/**
 * Class EventRepositoryEloquent
 * @package namespace App\Repositories\Elequent;
 */
class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    static $image_upload_directory = '/image/user/';
    static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserModel::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function insert($request)
    {
        $fill_array = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->location,

            'arabic_full_name' => $request->arabic_full_name,
            'profession' => $request->profession,
            'profession_location' => $request->profession_location,

            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'profession' => $request->profession,
            'bio' => $request->bio,
        ];

        if ($uploaded_file = file_upload('image', static::$image_upload_directory, static::$image_allowed_extension)) {
            $fill_array['image'] = $uploaded_file;
        }

        return $this->create($fill_array);
    }

    public function edit($id, $request)
    {
        $fill_array = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->location,

            'arabic_full_name' => $request->arabic_full_name,
            'profession' => $request->profession,
            'profession_location' => $request->profession_location,

            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'profession' => $request->profession,
            'bio' => $request->bio,
        ];

        if ($uploaded_file = file_upload('image', static::$image_upload_directory, static::$image_allowed_extension)) {
            $fill_array['image'] = $uploaded_file;
        }

        return $this->update($fill_array, $id);
    }

    public function insert_fb($fb_user_object)
    {
        $fill_array = [
            'email' => $fb_user_object->email,
            'first_name' => $fb_user_object->user['name'],
//            'last_name' => $fb_user_object->user['last_name'],

            'fb_id' => $fb_user_object->user['id'],
            'fb_token' => $fb_user_object->token,

        ];
        return $this->create($fill_array);

    }
}
