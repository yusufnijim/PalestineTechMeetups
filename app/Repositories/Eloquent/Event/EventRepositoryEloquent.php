<?php

namespace App\Repositories\Eloquent\Event;

use Prettus\Repository\Criteria\RequestCriteria;


use App\Repositories\Contracts\Event\EventRepository;
use App\Repositories\Eloquent\BaseRepositoryEloquent;
use App\Models\Event\EventModel;

/**
 * Class EventRepositoryEloquent
 * @package namespace App\Repositories\Elequent;
 */
class EventRepositoryEloquent extends BaseRepositoryEloquent implements EventRepository
{
    static $image_upload_directory = '/image/event/';
    static $image_allowed_extension = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg'];


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EventModel::class;
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
            'body' => $request->body,
            'permalink' => $request->permalink,
            'is_registration_open' => $request->is_registration_open,
            'max_registrars_count' => $request->max_registrars_count,
            'location' => $request->location,
            'date' => $request->date,
            'require_additional_fields' => $request->max_registrars_count,
            'is_published' => $request->is_published,
            'survey_id' => $request->survey_id,
            'type' => $request->type
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
            'body' => $request->body,
            'permalink' => $request->permalink,
            'is_registration_open' => $request->is_registration_open,
            'max_registrars_count' => $request->max_registrars_count,
            'location' => $request->location,
            'date' => $request->date,
            'require_additional_fields' => $request->max_registrars_count,
            'is_published' => $request->is_published,
            'survey_id' => $request->survey_id,
            'type' => $request->type
        ];

        if ($uploaded_file = file_upload('featured_image', static::$image_upload_directory, static::$image_allowed_extension)) {
            $fill_array['featured_image'] = $uploaded_file;
        }

        return $this->update($fill_array, $id);
    }

}
