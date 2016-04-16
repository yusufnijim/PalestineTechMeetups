<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateRequest as CreateRequest;

use App\Repositories\Contracts\Event\EventRepository;
use App\Repositories\Contracts\Event\VolunteerRepository;
use App\Repositories\Contracts\User\UserRepository;
use App\Repositories\Contracts\Survey\SurveyRepository;


class EventController extends MyBaseController
{
    protected $event_repo;
    protected $user_repo;
    protected $volunteer_repo;

    public function __construct(EventRepository $event_repo, UserRepository $user_repo,
                                VolunteerRepository $volunteer_repo, SurveyRepository $survey_repo)
    {
        $this->event_repo = $event_repo;
        $this->user_repo = $user_repo;
        $this->volunteer_repo = $volunteer_repo;
        $this->survey_repo = $survey_repo;
    }

    public function anyIndex()
    {
        can("event.view");

        $events = $this->event_repo->all();

        return view('event/index')
            ->with('events', $events);
    }


    public function getCreate()
    {
        can("event.create");

        return view('event/create')
            ->with("event", $this->event_repo->newInstance())
            ->with('surveys', $this->survey_repo->lists('name', 'id'));
    }

    public function postCreate(CreateRequest $request)
    {
        can("event.create");

        $event = $this->event_repo->insert($request);

        flash('event created successfully', 'success');
        return redirect("event/edit/" . $event->id);
    }


    public function getEdit($id)
    {
        can("event.edit");

        $event = $this->event_repo->find($id);
        return view('event/edit')
            ->with('event', $event)
            ->with('surveys', $this->survey_repo->lists('name', 'id'));
    }

    public function putEdit($id, CreateRequest $request)
    {
        can("event.edit");

        $this->event_repo->edit($id, $request);

        flash('event updated successfully', 'success');
        return redirect("event");
    }

    public function getSurveys()
    {
        can("event.survey");
        return $this->survey_repo->lists('name', 'id');
    }


    public function deleteDelete($id)
    {
        can("event.delete");

        $this->event_repo->delete($id);
        flash('event deleted successfully', 'success');
        return redirect("event");
    }

    public function getVolunteers($id)
    {
        can("event.volunteer");

        $event = $this->event_repo->find($id);
        $users_list = $this->user_repo->all()->lists('first_name', 'id');
        $volunteers_type_list = $this->volunteer_repo->type;

        $volunteers = $this->volunteer_repo->findByField('event_id', $id);

        return view('event/volunteer')
            ->with('event', $event)
            ->with('volunteers_type_list', $volunteers_type_list)
            ->with('volunteers', $volunteers)
            ->with('users_list', $users_list);

    }

    public function postVolunteers($event_id)
    {
        can("event.volunteer");

        $volunteer = $this->volunteer_repo->create([
            'event_id' => $event_id,
            'user_id' => request()->user_id,
            'type_id' => request()->type_id,
        ]);
        flash('volunteer added successfully', 'success');

        return redirect("/event/volunteers/$event_id");
    }

    public function deleteVolunteers($id)
    {
        can("event.volunteer");

        $this->volunteer_repo->delete(request()->record_id);
        flash('volunteer deleted successfully', 'success');
        return redirect("/event/volunteers/$id");
    }


}
