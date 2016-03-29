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
        $surveys = SurveyModel::all();
        return view('survey/index')->with('surveys', $surveys);
    }

    public function getCreate()
    {
        return view("survey/create")->with('survey', new SurveyModel());
    }

    public function postCreate()
    {
        SurveyModel::insert(request());
        return redirect('/survey');
    }

    public function getEdit($id)
    {
        $survey = SurveyModel::findOrfail($id);
        return view("survey/edit")->with('survey', $survey);
    }

    public function putEdit($id)
    {
        SurveyModel::edit($id, request());
        return redirect('/survey');
    }

    public function anyAnswers($survey_id) {
        dd($survey_id);
    }

    public function getAnswer($survey_id, $user_id) {
        UserModel::surveys();
    }

    public function getView($id)
    {
        $survey = SurveyModel::findOrFail($id);
        return view("survey/view")->with('survey', $survey);
    }

    public function postView($survey_id)
    {
        $survey = SurveyQuestionAnswerModel::insert($survey_id, request()->input());
        return redirect('/survey/view/' . $survey_id);
    }
}