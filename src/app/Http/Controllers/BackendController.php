<?php

namespace App\Http\Controllers;

use App\Models\EventModel;

class BackendController extends MyBaseController
{
    public function anyIndex()
    {
        $events = EventModel::all();

        return view('event/index')
            ->with('events', $events);
    }

    public function getView($id)
    {
        $event = EventModel::findOrFail($id);
        return view('event/view')->with('event', $event);
    }

}
