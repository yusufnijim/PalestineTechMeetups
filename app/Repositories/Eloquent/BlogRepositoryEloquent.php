<?php

namespace App\Repositories\Eloquent;

use App\Models\BlogModel;
use App\Repositories\Contracts\BlogRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class EventRepositoryEloquent.
 */
class BlogRepositoryEloquent extends BaseRepositoryEloquent implements BlogRepository
{
    public static $image_upload_directory = '/image/blog/';
    public static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return BlogModel::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function insert($request)
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
    }
}
