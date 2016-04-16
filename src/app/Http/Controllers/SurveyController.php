<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\Survey\SurveyRepository;

//use App\Models\Survey\SurveyModel;
use App\Models\Survey\SurveyQuestionModel;
use App\Models\Survey\SurveyQuestionAnswerModel;
use App\Models\Survey\SurveySubmissionModel;

//use App\Models\User\UserModel;

/**
 * contains users functions, registration, login...etc
 */
class SurveyController extends MyBaseController
{
    protected $survey_repo;

    public function __construct(SurveyRepository $survey_repo)
    {
        $this->survey_repo = $survey_repo;
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

        return view("survey/create")->with('survey', $this->survey_repo->newInstance());
    }

    public function postCreate()
    {
        can('event.survey');
        $this->survey_repo->create(request()->all());
        flash("survey created successfully", 'success');

        return redirect('/survey');
    }

    public function getEdit($id)
    {
        can('event.survey');

        $survey = $this->survey_repo->find($id);
        return view("survey/edit")
            ->with('survey', $survey)
            ->with('edit', true);
    }

    public function putEdit($id)
    {
        can('event.survey');

        $this->survey_repo->edit(request(), $id);
        flash("survey updated successfully", 'success');

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
        return view("survey/view")->with('survey', $survey);
    }


    public function getViewajax($id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($id);
        return view("survey/view_ajax")->with('survey', $survey);
    }

    public function postAnswer($survey_id)
    {
        can('event.manage');
        $user_id = auth()->check() ? auth()->user()->id : 0;

        $submission_id = SurveySubmissionModel::create([
            'user_id' => $user_id,
            'survey_id' => $survey_id,
        ])->id;
        $survey = SurveyQuestionAnswerModel::insert($survey_id, request()->input(), $submission_id);
        flash("thank you for submitting your answers", 'success');
        return redirect('/survey/view/' . $survey_id);
    }

    public function getResults($survey_id)
    {
        can('event.survey');
        $survey = $this->survey_repo->find($survey_id);

        return view('survey/result')
            ->with("survey", $survey);
    }

    public function getResult($survey_id, $user_id)
    {
        can('event.survey');
        $results = SurveyQuestionAnswerModel::where('survey_id', $survey_id)->where('user_id', $user_id)->get();

        return view('survey/result')
            ->with("results", $results);
    }

}