<?php

namespace App\Repositories\Eloquent\Event;
use App\Repositories\Contracts\Event\VolunteerRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\Eloquent\BaseRepositoryEloquent;
use App\Repositories\Contracts\User\UserRepository;

use App\Models\Event\VolunteerModel;

/**
 * Class EventRepositoryEloquent
 * @package namespace App\Repositories\Elequent;
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
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VolunteerModel::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
