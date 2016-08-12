<?php

namespace App\Policies;

use App\Models\EventModel;

class Policy
{
    /**
     * Grant all abilities to administrator.
     *
     * @param \App\Models\User $user
     * @param string           $ability
     *
     * @return bool
     */
    public function before(User $user, $ability)
    {
        return true;
//        if (session('status') === 'admin') {
//            return false;
//        }
    }

    /**
     * Determine if the given post can be changed by the user.
     *
     * @param \App\Models\User $user
     *
     * @return bool
     */
    public function change(EventModel $event)
    {
        return true;
    }
}
