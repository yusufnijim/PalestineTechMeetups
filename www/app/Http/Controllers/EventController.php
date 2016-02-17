<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateRequest as CreateRequest;
use App\Models\EventModel;

class EventController extends MyBaseController
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


    public function getCreate()
    {
        return view('event/create');
    }

    public function postCreate(CreateRequest $request)
    {
        EventModel::insert($request);
        session()->flash('flash_message', 'event created successfully');
        return redirect("event");
    }


    public function getEdit($id)
    {
        $event = EventModel::findOrFail($id);
        return view('event/edit')->with('event', $event);
    }

    public function putEdit($id, CreateRequest $request)
    {
        EventModel::edit($id, $request);
        session()->flash('flash_message', 'event updated successfully');
        return redirect("event");
    }


    public function postDelete($id)
    {
        EventModel::find($id)->delete();
        session()->flash('flash_message', 'event deleted successfully');
        return redirect("event");
    }
}
