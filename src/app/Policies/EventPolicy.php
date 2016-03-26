<?php

namespace App\Policies;

use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(UserModel $user)
    {
        return true;
    }

}
