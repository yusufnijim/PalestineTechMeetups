<?php

namespace App\Http\Controllers;

use App\Models\EventModel;

class BackendController extends MyBaseController
{
    public function anyIndex()
    {
        return view('backend/index');
    }

}
