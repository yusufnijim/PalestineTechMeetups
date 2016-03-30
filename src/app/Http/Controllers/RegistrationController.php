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
        if (!auth()->user()->hasPermission('registrations.manage')) {
            abort(403, 'Access denied');
        }
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
        $reg = RegistrationModel::where('event_id', $id)->get();
        return export_to_excel($reg, "event_" . $id);
    }


    public function postUpdateaccepted($id)
    {
        if (!auth()->user()->hasPermission('registrations.manage')) {
            abort(403, 'Access denied');
        }

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
        if (!auth()->user()->hasPermission('registrations.manage')) {
            abort(403, 'Access denied');
        }

        $reg = RegistrationModel::where('event_id', $id)
            ->where('user_id', request()['user_id'])
            ->first();
        $reg->update([
            'is_attended' => request()['is_attended'] == 1 ? 0 : 1,
        ]);

        return redirect("/registration/view/$id");
    }

    public function anyUpdateconfirmed($event_id, $user_id)
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
        return view("registration/email")->with('event', EventModel::findOrfail($event_id));
    }

    public function postSendemail()
    {
        dd(request()->input());
//        $users = UserModel::all();
//        foreach ($users as $user) {
//            \Mail::send('email/custom', ['user' => $user], function ($m) use ($user) {
//                $m->from('noreply@NablusTechMeetups.com', 'Nablus Tech Meetups');
//
//                $m->to('mukh_amin@yahoo.com', $user->name)->subject('Email !');
//            });
//        }
    }
}
