<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateRequest as CreateRequest;
use App\Models\EventModel;
use App\Models\User\UserModel;
use App\Models\VolunteerModel;

class EventController extends MyBaseController
{
    public function anyIndex()
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        $events = EventModel::with('survey')->get();

        return view('event/index')
            ->with('events', $events);
    }


    public function getCreate()
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        return view('event/create')
            ->with("event", new EventModel());
    }

    public function postCreate(CreateRequest $request)
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        $event = EventModel::insert($request);
        flash('event created successfully', 'success');
        return redirect("event/edit/" . $event->id);
    }


    public function getEdit($id)
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        $event = EventModel::findOrFail($id);
        return view('event/edit')
            ->with('event', $event);
    }

    public function putEdit($id, CreateRequest $request)
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        EventModel::edit($id, $request);
        flash('event updated successfully', 'success');
        return redirect("event");
    }


    public function postDelete($id)
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        EventModel::find($id)->delete();
        flash('event deleted successfully', 'success');
        return redirect("event");
    }

    public function getVolunteers($id)
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        $event = EventModel::findOrFail($id);
        $users_list = UserModel::lists('first_name', 'id');
        $volunteers_type_list = VolunteerModel::$type;

        $volunteers = VolunteerModel::where('event_id', $id)->get();

        return view('event/volunteer')
            ->with('event', $event)
            ->with('volunteers_type_list', $volunteers_type_list)
            ->with('volunteers', $volunteers)
            ->with('users_list', $users_list);

    }

    public function postVolunteers($id)
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        $volunteer = VolunteerModel::insert($id);
        flash('volunteer added successfully', 'success');

        return redirect("/event/volunteers/$id");
    }

    public function deleteVolunteers($id)
    {
        if (!auth()->user()->hasPermission('events.manage')) {
            abort(403, 'Access denied');
        }

        VolunteerModel::find(request()->record_id)->delete();
        flash('volunteer deleted successfully', 'success');
        return redirect("/event/volunteers/$id");
    }


}
