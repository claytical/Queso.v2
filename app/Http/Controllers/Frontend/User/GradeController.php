<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quest;
use App\Course;
use App\Submission;
use App\Link;
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
        $quests = $course->quests()->get();

        $list = [];
        foreach($quests as $quest) {
                //quest name, quest type, student name, revision number, date submitted
            $users = $quest->users()->where('graded', false)->get();

            foreach($users as $user) {

                if($quest->quest_type_id == 1) {
                    $attempt = Submission::where('user_id', '=', $user->id)
                                            ->where('quest_id', '=', $quest->id)
                                            ->where('revision', '=', $user->pivot->revision)
                                            ->first();
                }
                if($quest->quest_type_id == 4) {
                    $attempt = Link::where('user_id', '=', $user->id)
                                            ->where('quest_id', '=', $quest->id)
                                            ->where('revision', '=', $user->pivot->revision)
                                            ->first();
                }


               $list[] =  ["quest" => $quest->name, 
                            "type" => $quest->quest_type_id,
                            "student" => $user->name,
                            "attempt" => $attempt];
            }
        }

//        $users = $course->users();
//        $submissions = $users->quests()
//                                ->where('graded', '=', false)
//                                ->get();
//        $submissions = Course::find(session('current_course'))
 //                               ->user_quests()->get();
        return view('frontend.grade.submissions', ['lists' => $list])
            ->withUser(access()->user());
    }

    public function submission($id) {
        $submission = Submission::find($id);
        $quest = Quest::find($submission->quest_id);
        $skills = $quest->skills()->get();
        return view('frontend.grade.submission',   ['submission' => $submission, 
                                                    'quest' => $quest, 
                                                    'skills' => $skills]
                                                    )->withUser(access()->user());
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
