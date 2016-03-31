<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Survey\SurveyModel;
use App\Models\Survey\SurveyQuestionModel;
use App\Models\Survey\SurveyQuestionAnswerModel;
use App\Models\User\UserModel;

/**
 * contains users functions, registration, login...etc
 */
class SurveyController extends MyBaseController
{
    public function anyIndex()
    {
        can('event.manage');

        $surveys = SurveyModel::all();
        return view('survey/index')->with('surveys', $surveys);
    }

    public function getCreate()
    {
        can('event.manage');

        return view("survey/create")->with('survey', new SurveyModel());
    }

    public function postCreate()
    {
        can('event.manage');

        SurveyModel::insert(request());
        flash("survey created successfully", 'success');

        return redirect('/survey');
    }

    public function getEdit($id)
    {
        can('event.manage');

        $survey = SurveyModel::findOrfail($id);
        return view("survey/edit")->with('survey', $survey);
    }

    public function putEdit($id)
    {
        can('event.manage');

        SurveyModel::edit($id, request());
        flash("survey updated successfully", 'success');

        return redirect('/survey');
    }

    public function getView($id)
    {
        can('event.manage');

        $survey = SurveyModel::findOrFail($id);
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