<?php

namespace App\Http\Controllers;

use App\Models\Survey\SurveyQuestionAnswerModel;
use App\Models\Survey\SurveyQuestionModel;
use App\Models\Survey\SurveySubmissionModel;
//use App\Models\Survey\SurveyModel;
use App\Repositories\Contracts\Event\EventRepository;
use App\Repositories\Contracts\Event\RegistrationRepository;
use App\Repositories\Contracts\Survey\SurveyRepository;

//use App\Models\User\UserModel;

/**
 * contains users functions, registration, login...etc.
 */
class SurveyController extends MyBaseController
{
    protected $survey_repo;
    protected $event_repo;
    protected $registration_repo;

    /**
     * SurveyController constructor.
     * @param SurveyRepository $survey_repo
     * @param EventRepository $event_repo
     * @param RegistrationRepository $registration_repo
     */
    public function __construct(SurveyRepository $survey_repo, EventRepository $event_repo, RegistrationRepository $registration_repo)
    {
        $this->survey_repo = $survey_repo;
        $this->event_repo = $event_repo;
        $this->registration_repo = $registration_repo;
    }

    /**
     * index to pull all forms
     * @return $this
     */
    public function anyIndex()
    {
        can('event.survey');

        $surveys = $this->survey_repo->all();

        return view('survey/index')
            ->with('surveys', $surveys);
    }

    /**
     * get form create page
     * @return $this
     */
    public function getCreate()
    {
        can('event.survey');

        return view('survey/create')->with('survey', $this->survey_repo->newInstance());
    }

    /**
     * callback to create a form
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCreate()
    {
        can('event.survey');
        $survey = $this->survey_repo->insert(request()->all());
        $survey_id = $survey->id;
        flash('survey created successfully', 'success');

        return redirect('/survey/edit/' . $survey_id);
    }

    /**
     * get dynamic form edit page
     * @param $id
     * @return $this
     */
    public function getEdit($id)
    {
        can('event.survey');

        $survey = $this->survey_repo->find($id);

        return view('survey/edit')
            ->with('survey', $survey)
            ->with('edit', true);
    }

    /**
     * callback to edit dynamic form title and body
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function putEdit($id)
    {
        can('event.survey');

        $this->survey_repo->edit(request(), $id);
        flash('survey updated successfully', 'success');

        return redirect('/survey');
    }

    /**
     * callback to save form questions(admin area)
     * @param $survey_id
     * @return string
     */
    public function anySaveform($survey_id)
    {
        can('event.survey');
        $request = request();

        $survey = $this->survey_repo->find($survey_id);
        $survey->raw_form = request()->formdata;
        $survey->save();

        SurveyQuestionModel::insert($request, $survey_id);

        return json_encode(true);
    }

    /**
     * view specific form
     * @param $id
     * @return $this
     */
    public function getView($id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($id);

        return view('survey/view')->with('survey', $survey);
    }

    /**
     * AJAX callback, to fetch dynamic form results.
     * @param $id
     * @return $this
     */
    public function getViewajax($id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($id);

        return view('survey/view_ajax')->with('survey', $survey);
    }

    /**
     * callback to user form submission, to store questions' results
     * @param $survey_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAnswer($survey_id)
    {
        if (!auth()->check()) {
            abbort(404);
        }

        $user_id = auth()->user()->id;
        $event = $this->event_repo->findWhere(
            [
                'survey_id' => $survey_id,
            ]
        )->first();
        if ($event->is_registration_open) {
            flash('sorry registration has been closed for this event', 'error');
            return redirect(url('/'));
        }

        $submission_id = SurveySubmissionModel::create([
            'user_id' => $user_id,
            'survey_id' => $survey_id,
        ])->id;
        $survey = SurveyQuestionAnswerModel::insert($survey_id, request()->input(), $submission_id);

        if ($event) {
            $event_id = $event->id;

            $this->registration_repo->create(
                [
                    'user_id' => $user_id,
                    'event_id' => $event_id,
                ]
            );
            flash('thank you for submitting your answers', 'success');

            flash('sign up complete', 'success');

            return redirect(url('/'));
        }
    }

    /**
     * Get registration form results for specific dynamic form
     * @param $survey_id
     * @return $this
     */
    public function getResults($survey_id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($survey_id);

        return view('survey/result')
            ->with('survey', $survey);
    }

    /**
     * get dynamic form submission(per user)
     * @param $survey_id
     * @param int $user_id
     * @return $this|void
     */
    public function getResult($survey_id, $user_id = 0)
    {
        can('event.survey');
        if ($user_id) {
            global $survey_user_id;
            $survey_user_id = $user_id;
            $survey = $this->survey_repo->findWhere(['id' => $survey_id])->first();
            $survey = $survey->whereHas('submissions', function ($query) {
                global $survey_user_id;
                $query->where('user_id', $survey_user_id);
            })->where('id', $survey_id)->first();
//        SurveyQuestionAnswerModel::where('survey_id', $survey_id)->where('user_id', $user_id)->get();
        } else {
            $survey = $this->survey_repo->find($survey_id);
        }
        if (!$survey) {
            return abort(404);
        }

        return view('survey/result')
            ->with('survey', $survey);
    }
}
