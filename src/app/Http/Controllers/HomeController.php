<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use App\Models\EventModel;
use App\Jobs\ChangeLocale;


class HomeController extends MyBaseController
{
    public function anyIndex()
    {
        $blogs = BlogModel::published()->orderby('id', 'desc')->take(3)->get();
        $events = EventModel::published()->orderby('id', 'desc')->take(3)->get();
        return view("frontend.index")
            ->with('events', $events)
            ->with('blogs', $blogs);
    }

    public function getAbout()
    {
        return view("frontend.about");
    }


    public function getContact()
    {
        return view("frontend.contact");
    }

    public function postContact()
    {
        flash('thank you for contacting us', 'success');
        return redirect('/contact');
    }


    public function anySearch()
    {
        $query = request()->q;
        $results = [];
        return view("frontend.search")
            ->with('results', $results)
            ->with('query', $query)
            ;
    }

    /**
     * Change language.
     *
     * @param  App\Jobs\ChangeLocaleCommand $changeLocale
     * @param  String $lang
     * @return Response
     */
    public function language( $lang,
                              ChangeLocale $changeLocale)
    {
        $lang = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
        $changeLocale->lang = $lang;
        $this->dispatch($changeLocale);

        return redirect()->back();
    }

}
