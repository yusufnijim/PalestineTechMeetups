<?php

namespace App\Http\Controllers;

//use App\Models\Event\EventModel;
//use App\Models\Event\RegistrationModel;
//use App\Models\User\UserModel;
//
use App\Repositories\Contracts\Event\EventRepository;
use App\Repositories\Contracts\Event\RegistrationRepository;
use App\Repositories\Contracts\User\UserRepository;

class RegistrationController extends MyBaseController
{
    protected $event_repo;
    protected $user_repo;
    protected $registration_epo;

    public function __construct(EventRepository $event_repo, UserRepository $user_repo, RegistrationRepository $registration_epo)
    {
        $this->event_repo = $event_repo;
        $this->user_repo = $user_repo;
        $this->registration_epo = $registration_epo;
    }

    /**
     * This function will display the event page, with sign up details
     * @param $id
     * @return mixed
     */
    public function getSignup($id)
    {
        $event = $this->event_repo->find($id);
        $user = auth()->user();

        if ($user) {
            $status = $this->registration_epo->findWhere(
                [
                    'user_id' => isset($user->id) ? $user->id : NULL,
                    'event_id' => $id,
                    'is_cancelled' => 0,
                ]
            )->first();
        } else {
            $status = -1;
        }
        return view('registration/signup')
            ->with('event', $event)
            ->with('status', $status);
    }

    public function postSignup($id)
    {
        $user = auth()->user();
        $cancel = request()->cancel;

        $reg = $this->registration_epo->findWhere(
            [
                'user_id' => $user->id,
                'event_id' => $id,
            ]
        )->first();
        if ($reg AND count($reg->toArray())) { // user already registered
            if ($cancel) {
                $reg->is_cancelled = 1;
                $reg->save();
                flash('You cancelled your sign up', 'success');
            } else {
                $reg->is_cancelled = 0;
                $reg->save();
                flash('You re-signed up for this event', 'success');
            }
        } else {
            $this->registration_epo->create(
                [
                    'user_id' => $user->id,
                    'event_id' => $id,
                ]
            );
            flash('sign up complete', 'success');
        }


        return redirect("/registration/signup/$id");
    }

    public function getView($id)
    {
        can("registration.view");

        $event = $this->event_repo->find($id);
        $reg = $this->registration_epo->findByField('event_id', $id);

        //ToDo:: perhaps improve ? or cache
        $number_of_registrars = $reg->count();
        $number_of_accepted = $this->registration_epo->findWhere(['event_id' => $id])
            ->where('is_accepted', 1)->count();
        $number_of_attended = $this->registration_epo->findWhere(['event_id' => $id])
            ->where('is_attended', 1)->count();

        return view("registration/view")
            ->with('event', $event)
            ->with('reg', $reg)
            ->with('number_of_registrars', $number_of_registrars)
            ->with('number_of_accepted', $number_of_accepted)
            ->with('number_of_attended', $number_of_attended);
    }

    public function getExport($id)
    {
        can("registrations.view");

        $reg = $this->registration_epo->findWhere(['event_id' => $id]);
        return export_to_excel($reg, "event_" . $id);
    }


    public function postUpdateaccepted($id)
    {
        can("registration.edit");

        $reg = $this->registration_epo->findWhere([
            'event_id' => $id,
            'user_id' => request()['user_id'],
        ])->first();
        $reg->update([
            'is_accepted' => request()['is_accepted'] == 1 ? 0 : 1,
        ]);

        return redirect("/registration/view/$id");
    }


    public function postUpdateattended($id)
    {
        can("registration.update");

        $reg = $this->registration_epo->findWhere([
            'event_id' => $id,
            'user_id' => request()['user_id'],
        ])->first();
        $reg->update([
            'is_attended' => request()['is_attended'] == 1 ? 0 : 1,
        ]);


        return redirect("/registration/view/$id");
    }

    public function anyConfirm($event_id, $user_id)
    {
//        $user_id = auth()->user()->id;

        $reg = $this->registration_epo->findWhere([
            'event_id' => $event_id,
            'user_id' => $user_id,
        ])->first();

        if ($reg) {
            $reg->update([
                'is_confirmed' => 1,
            ]);
        }
        flash('Thank you for confirming your attendance', 'success');
        return redirect("/");
    }

    public function getSendemail($event_id)
    {
        can("registration.email");

        return view("registration/email")->with('event', EventModel::findOrfail($event_id));
    }

    public function postSendemail($event_id)
    {
        can("registration.email");

        // fetch users
        $reg = RegistrationModel::where('event_id', $event_id);

        if (request()->is_confirmed) {
            $reg->where('is_confirmed', 1);
        }
        if (request()->is_accepted) {
            $reg->where('is_accepted', 1);
        }
        if (request()->is_attended) {
            $reg->where('is_attended', 1);
        }
        $reg = $reg->get();

//        d(request()->input());
//        dd($reg);
        $count = 0;

        // loop through those users
        foreach ($reg as $instance) {
            $user = UserModel::find($instance->user_id);
            \Mail::send('email/custom', [
                'confirm_attendance' => request()->confirm_attendance,
                'event_id' => $event_id,
                'user' => $user,
                'body' => request()->body,
            ], function ($m) use ($user) {
                $m->from('noreply@NablusTechMeetups.com', 'Nablus Tech Meetups');

                $m->to($user->email, $user->name)->subject(request()->subject);
            });
            $count++;
        }

        // done!
        flash('emails in-queued for ' . $count, 'success');
        return redirect('/registration/view/' . $event_id);
    }

    public function postSendemailcount($event_id)
    {
        can("registration.email");

        // fetch users
        $reg = RegistrationModel::where('event_id', $event_id)
            ->where('is_confirmed', request()->is_confirmed)
            ->where('is_accepted', request()->is_accepted)
            ->where('is_attended', request()->is_attended)
            ->get();;
        dd($reg);
    }
}
