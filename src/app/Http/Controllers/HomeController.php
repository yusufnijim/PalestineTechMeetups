<?php

namespace App\Http\Controllers;

//use App\Models\EventModel;
use App\Models\User\UserModel;
use App\Models\User\RoleModel;

class HomeController extends MyBaseController
{
    public function anyIndex()
    {
        return view("frontend.index");
    }


}
