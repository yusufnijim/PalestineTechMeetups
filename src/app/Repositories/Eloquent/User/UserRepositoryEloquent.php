<?php

namespace App\Repositories\Eloquent\User;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Repositories\Eloquent\BaseRepositoryEloquent;
use App\Repositories\Contracts\User\UserRepository;
use App\Models\User\UserModel;

/**
 * Class EventRepositoryEloquent
 * @package namespace App\Repositories\Elequent;
 */
class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserModel::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
