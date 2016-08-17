<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Repositories\Contracts\ContactRepository;

class BackendController extends MyBaseController
{
    public function __construct(ContactRepository $contact_repo)
    {
        $this->contact_repo = $contact_repo;
    }

    public function anyIndex()
    {
        can('event.manage');
        return view('backend/index');
    }

    public function anyMessage()
    {
        can('message.view');
        $messages = $this->contact_repo->all();
        return view('backend/message')
            ->with('messages', $messages);
    }

    public function deleteMessage($id)
    {
        can('message.delete');
        flash('message deleted successfully', 'success');
        $this->contact_repo->delete($id);
        return redirect('/backend/message');
    }
}
