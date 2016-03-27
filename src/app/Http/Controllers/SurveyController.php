<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User\UserModel;
use App\Http\Requests\User\CreateRequest;


/**
 * contains users functions, registration, login...etc
 */
class SurveyController extends MyBaseController
{
    public function anyIndex() {
        echo "HI";
    }
}