<?php

namespace App\Repositories\Eloquent;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\Eloquent\BaseRepositoryEloquent;
use App\Repositories\Contracts\BlogRepository;
use App\Models\BlogModel;

/**
 * Class EventRepositoryEloquent
 * @package namespace App\Repositories\Elequent;
 */
class BlogRepositoryEloquent extends BaseRepositoryEloquent implements BlogRepository
{
    static $image_upload_directory = '/image/blog/';
    static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BlogModel::class;
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
            'title' => $request->title,

            'permalink' => $request->permalink,
            'body' => $request->body,
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

            'permalink' => $request->permalink,
            'body' => $request->body,
            'is_published' => $request->is_published,
        ];

        if ($uploaded_file = file_upload('featured_image', static::$image_upload_directory, static::$image_allowed_extension)) {
            $fill_array['featured_image'] = $uploaded_file;
        }
        return $this->update($fill_array, $id);
    }
}
