<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Vinelab\Http\Client as HttpClient;

/**
 * Class GradeController
 * @package App\Http\Controllers\Frontend
 */
class GradeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function submission_list()
    {
        return view('frontend.grade.submissions')
            ->withUser(access()->user());
    }

    public function submission() {
        return view('frontend.grade.submission')
            ->withUser(access()->user());
    }

    public function inclass()
    {
        return view('frontend.grade.inclass')
            ->withUser(access()->user());
    }    
}
