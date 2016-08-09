<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quest;
use App\Course;
use App\Submission;
use App\Link;
use App\Models\Access\User\User;
use App\Feedback;
use Illuminate\Http\Request;


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
        $submissions = Submission::where('quest_id', '=', $submission->quest_id)
                                        ->where('user_id', '=', $submission->user_id);
        $revision_count = $submissions->count();
        $revisions = $submissions->get();
        if($revision_count > 1) {
            $revisions = Submission::where('quest_id', '=', $submission->quest_id)
                                        ->where('user_id', '=', $submission->user_id)
                                        ->orderBy('revision')
                                        ->get();
        }
        $quest = Quest::find($submission->quest_id);
        $skills = $quest->skills()->get();

        return view('frontend.grade.submission',   ['submission' => $submission, 
                                                    'quest' => $quest, 
                                                    'skills' => $skills,
                                                    'revision_count' => $revision_count,
                                                    'revisions' => $revisions]
                                                    )->withUser(access()->user());
    }

    public function link() {
        return view('frontend.grade.link')
            ->withUser(access()->user());
    }

    public function confirm(Request $request) {
        $submission = Submission::find($request->submission_id);
        $user = User::find($submission->user_id);

        $feedback = new Feedback;
        $feedback->from_user_id = access()->user()->id;
        $feedback->to_user_id = $submission->user_id;
        $feedback->quest_id = $submission->quest_id;
        $feedback->revision = $submission->revision;
        $feedback->subtype = 1;
        $feedback->likes = 0;
        $feedback->note = $request->feedback;
        $feedback->save();
//TODO: notify user of feedback

//TODO: Check for revision

//TODO: Add to Skill History


        for($i = 0; $i < count($request->skills); $i++) {
            $skill_id = $request->skill_id[$i];
        //remove existing points for the quest
            $user->skills()->where('quest_id', $submission->quest_id)->detach($skill_id);
            if (is_numeric($request->skills[$i])) {
                $user->skills()->attach($skill_id, ['amount' => $request->skills[$i], 'quest_id' => $submission->quest_id]);
            }
            else {
                $user->skills()->attach($skill_id, ['amount' => 0, 'quest_id' => $submission->quest_id]);   
            }
        }
        
        $submission->graded = true;

        $submission->save();

        $user->quests()->where('revision', $submission->revision)
                        ->updateExistingPivot($submission->quest_id, ['graded' => true]);

        $quest = Quest::find($submission->quest_id);
        return redirect()->route('grade.submissions')->withFlashSuccess($quest->name . " has been successfully graded for " . $user->name . ".");

    }

    public function group_confirm(Request $request) {
        $student_list = [];
        foreach($request->students as $student) {
            $user = User::find($student);
            $student_list[] = $user->name;
            //Add to quest_user
            $user->quests()->attach($request->quest_id, ['graded' => true, 'revision' => 0])

            //add to user_skills
            for($i = 0; $i < count($request->skills); $i++) {
                $skill_id = $request->skill_id[$i];
            //remove existing points for the quest
                $user->skills()->where('quest_id', $request->quest_id)->detach($skill_id);
                if (is_numeric($request->skills[$i])) {
                    $user->skills()->attach($skill_id, ['amount' => $request->skills[$i], 'quest_id' => $request->quest_id]);
                }
                else {
                    $user->skills()->attach($skill_id, ['amount' => 0, 'quest_id' => $request->quest_id]);   
                }
            }

            //add feedback
            $feedback = new Feedback;
            $feedback->from_user_id = access()->user()->id;
            $feedback->to_user_id = $student;
            $feedback->quest_id = $request->quest_id;
            $feedback->revision = 0;
            $feedback->subtype = 1;
            $feedback->likes = 0;
            $feedback->note = $request->feedback;
            $feedback->save();            
            //notify user

        }
        $quest = Quest::find($request->quest_id);


        return redirect()->route('grade.inclass')->withFlashSuccess($quest->name . " graded for " . implode(",", $student_list) . ".");
    }


    public function inclass()
    {
        $quests = Course::find(session('current_course'))->quests()->where('quest_type_id', 2)->get();
        $users = Course::find(session('current_course'))->users()->count();
        return view('frontend.grade.inclass', ['quests' => $quests, 'users' => $users])
            ->withUser(access()->user());
    }    
    public function activity($quest_id) {
        $quest = Quest::find($quest_id);
        $students =  Course::find(session('current_course'))
                        ->users()
                        ->where('user_id', '!=', access()->user()->id)
                        ->get();
//        $quest->users()
        $skills = $quest->skills()->get();
        return view('frontend.grade.activity', ['quest' => $quest, 'skills' => $skills, 'students' => $students])
            ->withUser(access()->user());
    }
}
