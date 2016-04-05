<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use App\Models\EventModel;

class HomeController extends MyBaseController
{
    public function anyIndex()
    {
        can("event.manage");

        $blogs = BlogModel::published()->orderby('id', 'desc')->take(3)->get();
        $events = EventModel::published()->orderby('id', 'desc')->take(3)->get();
        return view("frontend.index")
            ->with('events', $events)
            ->with('blogs', $blogs);
    }


}
