<?php

namespace App\Repositories\Eloquent\Event;

use Prettus\Repository\Criteria\RequestCriteria;


use App\Repositories\Contracts\Event\RegistrationRepository;
use App\Repositories\Eloquent\BaseRepositoryEloquent;
use App\Models\Event\RegistrationModel;


/**
 * Class EventRepositoryEloquent
 * @package namespace App\Repositories\Elequent;
 */
class RegistrationRepositoryEloquent extends BaseRepositoryEloquent implements RegistrationRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RegistrationModel::class;
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
            'survey_id' => $request->survey_id
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
            'survey_id' => $request->survey_id
        ];

        if ($uploaded_file = file_upload('featured_image', static::$image_upload_directory, static::$image_allowed_extension)) {
            $fill_array['featured_image'] = $uploaded_file;
        }

        return $this->update($fill_array, $id);
    }

}
