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
        $blogs = $this->blog_repo->published()->latest()->paginate(4);
        $events = $this->event_repo->published()->latest()->paginate(3);
            $aboutus="  Hello, Laravel
    you are really complicated and I hate you
    Thank you Hello, Laravel
    you are really complicated and I hate you
    Thank youHello, Laravel
    you are really complicated and I hate you
    Thank youHello, Laravel
    you are really complicated and I hate you
    Thank youHello, Laravel
    you are really complicated and I hate you
    Thank you Hello, Laravel
    you are really complicated and I hate you
    Thank you Hello, Laravel
    you are really complicated and I hate you
    Thank you Hello, Laravel
    you are really complicated and I hate you
    Thank you";
        return view('frontend.index')
            ->with('events', $events)
            ->with('blogs', $blogs)
            ->with('aboutus',$aboutus);
    }

    public function getAbout()
    {
        return view('frontend.about');
    }

    public function getContact()
    {
        return view('frontend.contact');
    }

    public function getMoreawsomness()
    {
        return view('frontend.Moreawsomness');
    }
//by yamama
 public function getTimeline()
    {
         $events = $this->event_repo->published()->latest()->paginate(7);
           $numberOfevents =$this->event_repo->all()->count();
           $numberOfPages= ceil($numberOfevents/7);
        return view('frontend.timeline')
        ->with('events', $events)
        ->with('numberOfPages',$numberOfPages)
        ->with('numberOfEvents',$numberOfevents);
    }
     public function getNews()
    {
        $numberOfNews =$this->blog_repo->all()->count();
        $numberOfPages= ceil($numberOfNews/12);
        $blogs = $this->blog_repo->published()->latest()->paginate(12);
        return view('frontend.news')

        ->with('blogs', $blogs)
        ->with('numberOfPages',$numberOfPages)
        ->with('numberOfNews',$numberOfNews);
    }
    public function getHandson()
    {
        return view('frontend.handson');
    }
      public function getMonthlymeetups()
    {
        return view('frontend.Monthlymeetups');
    }
    //end yamama
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
