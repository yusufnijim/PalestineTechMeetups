<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\RegistrationModel;

class RegistrationController extends MyBaseController
{

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
        session()->flash('flash_message', 'sign up complete');

        return redirect("/registration/signup/$id");
    }

    public function getView($id)
    {
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

    public function postUpdateaccepted($id)
    {
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
        $reg = RegistrationModel::where('event_id', $id)
            ->where('user_id', request()['user_id'])
            ->first();
        $reg->update([
            'is_attended' => request()['is_attended'] == 1 ? 0 : 1,
        ]);

        return redirect("/registration/view/$id");
    }

}
