<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\Contracts\BaseRepository as BaseRepositoryInterface;

class BaseRepositoryEloquent extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
//        return EventModel::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
//        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function new()
    {
        return $this->model->newInstance([]);
    }
}