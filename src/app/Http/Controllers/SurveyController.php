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
    protected $registration_epo;

    public function __construct(SurveyRepository $survey_repo, EventRepository $event_repo, RegistrationRepository $registration_epo)
    {
        $this->survey_repo = $survey_repo;
        $this->event_repo = $event_repo;
        $this->registration_epo = $registration_epo;
    }

    public function anyIndex()
    {
        can('event.survey');

        $surveys = $this->survey_repo->all();

        return view('survey/index')
            ->with('surveys', $surveys);
    }

    public function getCreate()
    {
        can('event.survey');

        return view('survey/create')->with('survey', $this->survey_repo->newInstance());
    }

    public function postCreate()
    {
        can('event.survey');
        $survey = $this->survey_repo->insert(request()->all());
        $survey_id = $survey->id;
        flash('survey created successfully', 'success');

        return redirect('/survey/edit/'.$survey_id);
    }

    public function getEdit($id)
    {
        can('event.survey');

        $survey = $this->survey_repo->find($id);

        return view('survey/edit')
            ->with('survey', $survey)
            ->with('edit', true);
    }

    public function putEdit($id)
    {
        can('event.survey');

        $this->survey_repo->edit(request(), $id);
        flash('survey updated successfully', 'success');

        return redirect('/survey');
    }

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

    public function getView($id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($id);

        return view('survey/view')->with('survey', $survey);
    }

    public function getViewajax($id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($id);

        return view('survey/view_ajax')->with('survey', $survey);
    }

    public function postAnswer($survey_id)
    {
        can('event.manage');
        $user_id = auth()->check() ? auth()->user()->id : 0;

        $submission_id = SurveySubmissionModel::create([
            'user_id'   => $user_id,
            'survey_id' => $survey_id,
        ])->id;
        $survey = SurveyQuestionAnswerModel::insert($survey_id, request()->input(), $submission_id);

        $event = $this->event_repo->findWhere(
            [
                'survey_id' => $survey_id,
            ]
        )->first();

        if ($event) {
            $event_id = $event->id;

            $this->registration_epo->create(
                [
                    'user_id'  => $user_id,
                    'event_id' => $event_id,
                ]
            );
            flash('thank you for submitting your answers', 'success');

            flash('sign up complete', 'success');

            return redirect("/registration/signup/$event_id");
        }
    }

    public function getResults($survey_id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($survey_id);

        return view('survey/result')
            ->with('survey', $survey);
    }

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
