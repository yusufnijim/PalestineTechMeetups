<?php

namespace App\Repositories\Eloquent\Event;

use App\Models\Event\VolunteerModel;
use App\Repositories\Contracts\Event\VolunteerRepository;
use App\Repositories\Eloquent\BaseRepositoryEloquent;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class EventRepositoryEloquent.
 */
class VolunteerRepositoryEloquent extends BaseRepositoryEloquent implements VolunteerRepository
{
    public $type = [
        0 => 'Speaker',
        1 => 'Organizer',
        2 => 'Volunteer',
        3 => 'Mentor',
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return VolunteerModel::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
