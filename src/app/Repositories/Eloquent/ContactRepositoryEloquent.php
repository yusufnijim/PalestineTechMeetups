<?php

namespace App\Repositories\Eloquent;

use App\Models\ContactModel;
use App\Repositories\Contracts\ContactRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class EventRepositoryEloquent.
 */
class ContactRepositoryEloquent extends BaseRepositoryEloquent implements ContactRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return ContactModel::class;
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
            'name'  => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'body'  => $request->body,
        ];


        return $this->create($fill_array);
    }
}
