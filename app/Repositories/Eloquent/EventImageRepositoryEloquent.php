<?php

namespace App\Repositories\Eloquent;

use App\Models\EventImageModel;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class EventRepositoryEloquent.
 */
class EventImageRepositoryEloquent extends BaseRepositoryEloquent 
{
    public static $image_upload_directory = '/image/event/';
    public static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return EventImageModel::class;
    }

    /*public function insert($request)
    {
        $fill_array = [
            'title' => $request->title,

            'permalink'    => $request->permalink,
            'body'         => $request->body,
            'is_published' => $request->is_published,
        ];

        if ($uploaded_file = file_upload('featured_image', static::$image_upload_directory, static::$image_allowed_extension)) {
            $fill_array['featured_image'] = $uploaded_file;
        }

        return $this->create($fill_array);
    }

    public function edit($id, $request)
    {
        $fill_array = [
            'title' => $request->title,

            'permalink'    => $request->permalink,
            'body'         => $request->body,
            'is_published' => $request->is_published,
        ];

        if ($uploaded_file = file_upload('featured_image', static::$image_upload_directory, static::$image_allowed_extension)) {
            $fill_array['featured_image'] = $uploaded_file;
        }

        return $this->update($fill_array, $id);
    }*/
}
