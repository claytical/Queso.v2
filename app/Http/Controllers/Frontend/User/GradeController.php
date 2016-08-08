<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quest;
use App\Course;
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
    public function submission_list() {
        $course = Course::find(session('current_course'));
        $submissions = $course->users()
                                ->quests()
                                ->where('graded', '=', false)
                                ->get();

        return view('frontend.grade.submissions', ['submissions' => $submissions])
            ->withUser(access()->user());
    }

    public function submission() {
        return view('frontend.grade.submission')
            ->withUser(access()->user());
    }

    public function link() {
        return view('frontend.grade.link')
            ->withUser(access()->user());
    }

    public function confirm() {
        return view('frontend.grade.remaining')
            ->withUser(access()->user());
    }

    public function group_confirm() {
        return view('frontend.grade.group_remaining')
            ->withUser(access()->user());
    }


    public function inclass()
    {
        return view('frontend.grade.inclass')
            ->withUser(access()->user());
    }    
    public function activity() {
        return view('frontend.grade.activity')
            ->withUser(access()->user());
    }
}
