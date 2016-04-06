<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\RegistrationModel;
use App\Models\User\UserModel;

class RegistrationController extends MyBaseController
{

    /**
     * This function will display the event page, with sign up details
     * @param $id
     * @return mixed
     */
    public function getSignup($id)
    {
        $event = EventModel::findOrFail($id);
        $user = auth()->user();

        if ($user) {
            $status = RegistrationModel::where(
                [
                    'user_id' => isset($user->id) ? $user->id : NULL,
                    'event_id' => $id
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

        RegistrationModel::firstOrCreate(
            [
                'user_id' => $user->id,
                'event_id' => $id,
            ]
        );
        flash('sign up complete', 'success');

        return redirect("/registration/signup/$id");
    }

    public function getView($id)
    {
        can("registrations.manage");

        $event = EventModel::findOrFail($id);
        $reg = RegistrationModel::where('event_id', $id)->get();

        //ToDo:: perhaps improve ? or cache
        $number_of_registrars = $reg->count();
        $number_of_accepted = RegistrationModel::where('event_id', $id)
            ->where('is_accepted', 1)->get()->count();
        $number_of_attended = RegistrationModel::where('event_id', $id)
            ->where('is_attended', 1)->get()->count();

        return view("registration/view")
            ->with('event', $event)
            ->with('reg', $reg)
            ->with('number_of_registrars', $number_of_registrars)
            ->with('number_of_accepted', $number_of_accepted)
            ->with('number_of_attended', $number_of_attended);
    }

    public function getExport($id)
    {
        can("registrations.manage");

        $reg = RegistrationModel::where('event_id', $id)->get();
        return export_to_excel($reg, "event_" . $id);
    }


    public function postUpdateaccepted($id)
    {
        can("registrations.manage");

        $reg = RegistrationModel::where('event_id', $id)
            ->where('user_id', request()['user_id'])
            ->first();
        $reg->update([
            'is_accepted' => request()['is_accepted'] == 1 ? 0 : 1,
        ]);

        return redirect("/registration/view/$id");
    }


    public function postUpdateattended($id)
    {
        can("registrations.manage");

        $reg = RegistrationModel::where('event_id', $id)
            ->where('user_id', request()['user_id'])
            ->first();
        $reg->update([
            'is_attended' => request()['is_attended'] == 1 ? 0 : 1,
        ]);

        return redirect("/registration/view/$id");
    }

    public function anyConfirm($event_id, $user_id)
    {
        $reg = RegistrationModel::where('event_id', $event_id)
            ->where('user_id', $user_id)
            ->first();

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
        can("registrations.manage");

        return view("registration/email")->with('event', EventModel::findOrfail($event_id));
    }

    public function postSendemail($event_id)
    {
        can("registrations.manage");

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
        // fetch users
        $reg = RegistrationModel::where('event_id', $event_id)
            ->where('is_confirmed', request()->is_confirmed)
            ->where('is_accepted', request()->is_accepted)
            ->where('is_attended', request()->is_attended)
            ->get();;
        dd($reg);
    }
}
