<?php

namespace App\Http\Controllers;

//use App\Models\BlogModel;
//use App\Models\EventModel;
use App\Jobs\ChangeLocale;
use App\Repositories\Contracts\BlogRepository;
use App\Repositories\Contracts\ContactRepository;
use App\Repositories\Contracts\Event\EventRepository;

class FrontController extends MyBaseController
{
    protected $blog_repo;
    protected $event_repo;
    protected $contact_repo;

    public function __construct(BlogRepository $blog_repo, EventRepository $event_repo, ContactRepository $contact_repo)
    {
        $this->blog_repo = $blog_repo;
        $this->event_repo = $event_repo;
        $this->contact_repo = $contact_repo;
    }

    public function anyIndex()
    {
        $blogs = $this->blog_repo->published()->latest()->paginate(3);
        $events = $this->event_repo->published()->latest()->paginate(3);

        return view('frontend.index')
            ->with('events', $events)
            ->with('blogs', $blogs);
    }

    public function getAbout()
    {
        return view('frontend.about');
    }

    public function getContact()
    {
        return view('frontend.contact');
    }

    public function postContact()
    {
        $this->contact_repo->insert(request());
        flash('thank you for contacting us', 'success');

        return redirect('/contact');
    }

    public function anySearch()
    {
        $query = request()->q;
        $results = [];

        return view('frontend.search')
            ->with('results', $results)
            ->with('query', $query);
    }

    /**
     * Change language.
     *
     * @param App\Jobs\ChangeLocaleCommand $changeLocale
     * @param string                       $lang
     *
     * @return Response
     */
    public function language($lang,
                             ChangeLocale $changeLocale)
    {
        $lang = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
        $changeLocale->lang = $lang;
        $this->dispatch($changeLocale);

        return redirect()->back();
    }
}
