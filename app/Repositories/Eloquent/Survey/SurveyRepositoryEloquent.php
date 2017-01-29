<?php

namespace App\Repositories\Eloquent\Survey;

use App\Models\Survey\SurveyModel;
use App\Repositories\Contracts\Survey\SurveyRepository;
use App\Repositories\Eloquent\BaseRepositoryEloquent;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class EventRepositoryEloquent.
 */
class SurveyRepositoryEloquent extends BaseRepositoryEloquent implements SurveyRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return SurveyModel::class;
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
            'name'        => $request['name'],
            'description' => $request['description'],
        ];

        return $this->create($fill_array);
    }

    public function edit($request, $id)
    {
        $fill_array = [
            'name'        => $request['name'],
            'description' => $request['description'],
        ];

        return $this->update($fill_array, $id);
    }
}
