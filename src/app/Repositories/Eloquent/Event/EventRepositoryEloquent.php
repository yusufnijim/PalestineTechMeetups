<?php

namespace App\Repositories\Eloquent\Event;
use Prettus\Repository\Criteria\RequestCriteria;


use App\Repositories\Eloquent\BaseRepositoryEloquent;
use App\Repositories\Contracts\Event\EventRepository;
use App\Models\Event\EventModel;

/**
 * Class EventRepositoryEloquent
 * @package namespace App\Repositories\Elequent;
 */
class EventRepositoryEloquent extends BaseRepositoryEloquent implements EventRepository
{
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
}
