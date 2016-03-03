<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\CreateRequest as CreateRequest;
use App\Models\EventModel;
use App\Models\RegistrationModel;

class RegistrationController extends MyBaseController
{

    public function getSignup($id)
    {
        $event = EventModel::findOrFail($id);
        $user = auth()->user();

        $status = RegistrationModel::where(
            [
                'user_id' => $user->id,
                'event_id' => $id
            ]
        )->first();

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
        return view("registration/view")
            ->with('event', $event)
            ->with('reg', $reg);
    }

    public function postUpdateAttended($id)
    {
        $reg = RegistrationModel::where('event_id', $id)
            ->where('user_id', request()['user_id'])
            ->first();
        $reg->update([
            'is_attend' => request()['is_attended'] == 1 ? 0 : 1,
        ]);

        return redirect("/registration/view/$id");
    }

    public function postUpdateAccepted($id)
    {
        $reg = RegistrationModel::where('event_id', $id)
            ->where('user_id', request()['user_id'])
            ->first();
        $reg->update([
            'is_attend' => request()['is_accepted'] == 1 ? 0 : 1,
        ]);

        return redirect("/registration/view/$id");
    }


}
