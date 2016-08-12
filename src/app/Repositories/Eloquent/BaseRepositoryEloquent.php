<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepository as BaseRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class BaseRepositoryEloquent extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        //        return EventModel::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        //        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function newInstance()
    {
        return $this->model->newInstance([]);
    }

    public function published()
    {
        $query = function ($query) {
            return $query->where('is_published', 1);
        };
        $this->scopeQuery($query);

        return $this;
    }

    public function latest()
    {
        $query = function ($query) {
            return $query->orderBy('id', 'desc');
        };
        $this->scopeQuery($query);

        return $this;
    }
}
