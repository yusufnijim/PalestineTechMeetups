<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateRequest as CreateRequest;
use App\Models\EventModel;
use App\Models\User\UserModel;
use App\Models\VolunteerModel;
use App\Models\Survey\SurveyModel;

class EventController extends MyBaseController
{
    public function anyIndex()
    {
        can("event.manage");

        $events = EventModel::with('survey')->get();

        return view('event/index')
            ->with('events', $events);
    }


    public function getCreate()
    {
        can("event.manage");

        return view('event/create')
            ->with("event", new EventModel())
            ->with('surveys', SurveyModel::lists('name','id'));
    }

    public function getSurveys() {
        can("event.manage");
        return SurveyModel::lists('name','id');
    }
    public function postCreate(CreateRequest $request)
    {
        can("event.manage");

        $event = EventModel::insert($request);
        flash('event created successfully', 'success');
        return redirect("event/edit/" . $event->id);
    }


    public function getEdit($id)
    {
        can("event.manage");

        $event = EventModel::findOrFail($id);
        return view('event/edit')
            ->with('event', $event)
            ->with('surveys', SurveyModel::lists('name','id'));
    }

    public function putEdit($id, CreateRequest $request)
    {
        can("event.manage");

        EventModel::edit($id, $request);
        flash('event updated successfully', 'success');
        return redirect("event");
    }


    public function postDelete($id)
    {
        can("event.manage");

        EventModel::find($id)->delete();
        flash('event deleted successfully', 'success');
        return redirect("event");
    }

    public function getVolunteers($id)
    {
        can("event.manage");

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
        can("event.manage");

        $volunteer = VolunteerModel::insert($id);
        flash('volunteer added successfully', 'success');

        return redirect("/event/volunteers/$id");
    }

    public function deleteVolunteers($id)
    {
        can("event.manage");

        VolunteerModel::find(request()->record_id)->delete();
        flash('volunteer deleted successfully', 'success');
        return redirect("/event/volunteers/$id");
    }


}
