<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Repositories\Contracts\Survey\SurveyRepository;

//use App\Models\Survey\SurveyModel;
//use App\Models\Survey\SurveyQuestionModel;
//use App\Models\Survey\SurveyQuestionAnswerModel;
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
        can('event.manage');

        $surveys = $this->survey_repo->all();
        return view('survey/index')->with('surveys', $surveys);
    }

    public function getCreate()
    {
        can('event.manage');

        return view("survey/create")->with('survey', $this->survey_repo->new());
    }

    public function postCreate()
    {
        can('event.manage');

        $this->survey_repo->create(request()->all());
        flash("survey created successfully", 'success');

        return redirect('/survey');
    }

    public function getEdit($id)
    {
        can('event.manage');

        $survey = $this->survey_repo->find($id);
        return view("survey/edit")
            ->with('survey', $survey)
            ->with('edit', true);
    }

    public function putEdit($id)
    {
        can('event.manage');

        $this->survey_repo->update(request()->all(), $id);
        flash("survey updated successfully", 'success');

        return redirect('/survey');
    }


    public function anySaveform($survey_id)
    {
        $request = request();

        $survey = $this->survey_repo->find($survey_id);
        $survey->raw_form = request()->formdata;
        $survey->save();

        SurveyQuestionModel::insert($request, $survey_id);

        return json_encode(true);
    }


    public function getView($id)
    {
        can('event.manage');
        $survey =$this->survey_repo->find($id);
        return view("survey/view")->with('survey', $survey);
    }

    public function postAnswer($survey_id)
    {
        can('event.manage');

        $survey = SurveyQuestionAnswerModel::insert($survey_id, request()->input());
        flash("thank you for submitting your asnwers", 'success');
        return redirect('/survey/view/' . $survey_id);
    }


    public function getResults($survey_id)
    {
        $results = SurveyQuestionAnswerModel::where('survey_id', $survey_id)->get();

        return view('survey/result')
            ->with("results", $results);
    }

    public function getResult($survey_id, $user_id)
    {
        $results = SurveyQuestionAnswerModel::where('survey_id', $survey_id)->where('user_id', $user_id)->get();

        return view('survey/result')
            ->with("results", $results);
    }

}