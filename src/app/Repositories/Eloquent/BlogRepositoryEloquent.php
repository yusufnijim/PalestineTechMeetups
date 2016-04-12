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
}
