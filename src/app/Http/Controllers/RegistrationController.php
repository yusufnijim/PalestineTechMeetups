<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\RegistrationModel;

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
        session()->flash('flash_message', 'sign up complete');

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


        // filename for download
        $filename = "event_" . $id . "_" . date('Ymd') . ".xls";

        // send header information
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach ($reg as $row) {
            $record = $row['attributes'];
            if (!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($record)) . "\r\n";
                $flag = true;
            }
            echo implode("\t", array_values($record)) . "\r\n";
        }
    }

    function cleanData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
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

}
