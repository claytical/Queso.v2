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
use App\Notice;
use Illuminate\Http\Request;
use App\GroupQuest;
use Mail;

//use Vinelab\Http\Client as HttpClient;

/**
 * Class GradeController
 * @package App\Http\Controllers\Frontend
 */
class GradeController extends Controller {

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function submission_list($course_id) {
        $course = Course::find($course_id);
        $quests = $course->quests()->where('groups', '=', false)->get();
        $group_quests = $course->quests()->where('groups', '=', true)->get();

        $list = [];
        foreach($quests as $quest) {
                //quest name, quest type, student name, revision number, date submitted
            $users = $quest->users()->where('graded', false)->get();

            foreach($users as $user) {

                if($quest->quest_type_id == 1 || $quest->quest_type_id == 5) {
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
                            "quest_id" => $quest->id,
                            "type" => $quest->quest_type_id,
                            "student" => $user->name,
                            "attempt" => $attempt];
            }
        }
        foreach($group_quests as $quest) {
            $groups = GroupQuest::where('quest_id', '=', $quest->id)
                                    ->where('graded', '=', false)
                                    ->get();
            foreach($groups as $group) {
                if($quest->quest_type_id == 1 || $quest->quest_type_id == 6) {
                    $attempt = Submission::find($group->attempt_id);
                }
                if($quest->quest_type_id == 4 || $quest->quest_type_id == 7) {
                    $attempt = Link::find($group->attempt_id);
                }

               $list[] =  ["quest" => $quest->name,
                            "quest_id" => $quest->id,
                            "type" => $quest->quest_type_id,
                            "student" => $group->users->implode('name', ','),
                            "attempt" => $attempt];
            }
        }

        return view('frontend.grade.submissions', ['lists' => $list, 'course_id' => $course_id])
            ->withUser(access()->user());
    }


    public function quest($quest_id, $attempt_id) {

        $quest = Quest::find($quest_id);
        $files = false;
        switch($quest->quest_type_id) {
            case '1':
            /* RESPONSE */
            case '5':
            /* UPLOAD */
            case '6':
            /* GROUP UPLOAD */
                $attempt = Submission::find($attempt_id);
                $attempts = Submission::where('quest_id', '=', $quest->id)
                                            ->where('user_id', '=', $attempt->user_id);
               $files = $attempt->files;
               $view_name = "frontend.grade.response";
                break;
            case '2':
            /* MANUAL OR INSTANT  */

            case '3':
            /* VIDEO */
            case '4':
            /* SOLO LINK */
            case '7':
            /* GROUP LINK */
                $attempt = Link::find($attempt_id);
                $attempts = Link::where('quest_id', '=', $quest->id)
                                ->where('user_id', '=', $attempt->user_id);
               $view_name = "frontend.grade.link";

                break;
        }

        $student = User::find($attempt->user_id);
        $positive_feedback = Feedback::where('to_user_id', '=', $attempt->user_id)
                                ->where('quest_id', '=', $quest_id)
                                ->where('revision', '=', $attempt->revision)
                                ->where('subtype', '=', 2)
                                ->get();

        $negative_feedback = Feedback::where('to_user_id', '=', $attempt->user_id)
                                ->where('quest_id', '=', $quest_id)
                                ->where('revision', '=', $attempt->revision)
                                ->where('subtype', '=', 3)
                                ->get();
        $previous_feedback = Feedback::where('to_user_id', '=', $attempt->user_id)
                                        ->where('quest_id', '=', $quest_id)
                                        ->where('subtype', '=', 1)
                                        ->orderBy('revision')
                                        ->get();

        $revision_count = $attempts->count();
        $revisions = $attempts->get();
        $skills = $quest->skills()->get();

        return view($view_name,   ['attempt' => $attempt, 
                                                    'quest' => $quest, 
                                                    'skills' => $skills,
                                                    'revision_count' => $revision_count,
                                                    'revisions' => $revisions,
                                                    'files' => $files,
                                                    'positive_feedback' => $positive_feedback,
                                                    'negative_feedback' => $negative_feedback,
                                                    'previous_feedback' => $previous_feedback,
                                                    'student' => $student]
                                                    )->withUser(access()->user());
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
        $user = User::find($submission->user_id);
        return view('frontend.grade.submission',   ['submission' => $submission, 
                                                    'quest' => $quest, 
                                                    'skills' => $skills,
                                                    'revision_count' => $revision_count,
                                                    'revisions' => $revisions,
                                                    'user' => $user]
                                                    );
    }

    public function link() {
        return view('frontend.grade.link')
            ->withUser(access()->user());
    }

    public function confirm(Request $request) {
        $quest = Quest::find($request->quest_id);
        switch($quest->quest_type_id) {
            case 1:
            case 5:
            case 6:
                $attempt = Submission::find($request->attempt_id);
                break;
            case 4:
            case 7:
                $attempt = Link::find($request->attempt_id);
                break;
        }

        $users = [];

        if($quest->groups) {
            //figure out group users and send feedback
            $group = GroupQuest::where('quest_id', '=', $quest->id)
                                ->where('attempt_id', '=', $request->attempt_id)
                                ->first();
            if($group) {
                $users = $group->users;
            }
            else {
                $users[] = User::find($attempt->user_id);
            }
        }
        else {
            $users[] = User::find($attempt->user_id);
        }
        foreach($users as $user) {
 
            $feedback = new Feedback;
            $feedback->from_user_id = access()->user()->id;
            $feedback->to_user_id = $user->id;
            $feedback->quest_id = $attempt->quest_id;
            $feedback->revision = $attempt->revision;
            $feedback->subtype = 1;
            $feedback->likes = 0;
            $feedback->note = $request->feedback;
            $feedback->save();
        

    //TODO: Check for revision

    //TODO: Add to Skill History

            $total_points = 0;
                for($i = 0; $i < count($request->skills); $i++) {
                    $skill_id = $request->skill_id[$i];
                //remove existing points for the quest
    //                    $user->skills()->where('quest_id', $attempt->quest_id)->detach($skill_id);
                        if (is_numeric($request->skills[$i])) {
                            $user->skills()->attach($skill_id, ['amount' => $request->skills[$i], 'quest_id' => $attempt->quest_id]);
                            $total_points += $request->skills[$i];
                        }
                        else {
                            $user->skills()->attach($skill_id, ['amount' => 0, 'quest_id' => $attempt->quest_id]);   
                    }
                }
                
            $attempt->graded = true;
            $attempt->save();
            //send notification to user
            $notice = new Notice;
            $notice->user_id = $user->id;
            $notice->message = $quest->name . " has been graded. You received " . $total_points . " of " . $quest->skills()->sum('amount') . " points.";
            if($quest->groups) {
                $notice->url ="quest/".$quest->id."/group/feedback";
            }
            else {
                $notice->url = "quest/". $quest->id ."/feedback";
            }
            $notice->course_id = $quest->course_id;
            $notice->save();
            $prof = access()->user();
            /*
            Mail::send('emails.instructor_feedback', ['link' => $notice->url, 'sender' => $prof, 'feedback' => $request->feedback, 'quest' => $quest, 'total_points' => $total_points, 'sum_points' => $quest->skills()->sum('amount')], 
                function ($message) use ($quest, $user, $prof) {
                    $message->subject($quest->name . " has been graded");
                    $message->from($prof->email, $prof->name);
                    $message->to($user->email);
                });
            */
            $user->quests()->where('revision', $attempt->revision)
                        ->updateExistingPivot($attempt->quest_id, ['graded' => true]);
        }
        
        if($quest->groups) {
            if($group) {
                $group->graded = true;
                $group->save();
            }
           return redirect()->route('grade.submissions', $quest->course_id)->withFlashSuccess($quest->name . " has been successfully graded for " . $users->implode('name', ',') . ".");
        }
        
        return redirect()->route('grade.submissions', $quest->course_id)->withFlashSuccess($quest->name . " has been successfully graded for " . $users[0]->name . ".");
 
    }

    public function watched(Request $request) {
        $quest = Quest::find($request->quest_id);
        $user = User::find($request->user_id);

        $total_points = 0;
        for($i = 0; $i < count($request->skills); $i++) {
            $skill_id = $request->skill_id[$i];
            if (is_numeric($request->skills[$i])) {
                $user->skills()->attach($skill_id, ['amount' => $request->skills[$i], 'quest_id' => $request->quest_id]);
                $total_points += $request->skills[$i];
            }
            else {
                $user->skills()->attach($skill_id, ['amount' => 0, 'quest_id' => $request->quest_id]);   
            }
        }
        $user->quests()->attach($request->quest_id, ['graded' => true, 'revision' => 0]);

        return redirect()->route('frontend.user.dashboard')
                            ->withFlashSuccess("Received " . $total_points . " points for " . $quest->name . ".");
    }

    public function group_confirm(Request $request) {
        $student_list = [];
        $quest = Quest::find($request->quest_id);
        if($request->has('students')) {
            foreach($request->students as $student) {
                $user = User::find($student);
                $student_list[] = $user->name;
                //Add to quest_user
                $user->quests()->attach($request->quest_id, ['graded' => true, 'revision' => 0]);

                //add to user_skills
                $total_points = 0;
                for($i = 0; $i < count($request->skills); $i++) {
                    $skill_id = $request->skill_id[$i];
                //remove existing points for the quest
    //                $user->skills()->where('quest_id', $request->quest_id)->detach($skill_id);
                    if (is_numeric($request->skills[$i])) {
                        $user->skills()->attach($skill_id, ['amount' => $request->skills[$i], 'quest_id' => $request->quest_id]);
                        $total_points += $request->skills[$i];
                    }
                    else {
                        $user->skills()->attach($skill_id, ['amount' => 0, 'quest_id' => $request->quest_id]);   
                    }
                }

                //add feedback
                $prof = access()->user();
                $feedback = new Feedback;
                $feedback->from_user_id = $prof->id;
                $feedback->to_user_id = $student;
                $feedback->quest_id = $request->quest_id;
                $feedback->revision = 0;
                $feedback->subtype = 1;
                $feedback->likes = 0;
                $feedback->note = $request->feedback;
                $feedback->save();            
                //notify user
                $notice = new Notice;
                $notice->user_id = $student;
                $notice->message = $quest->name . " has been graded. You received " . $total_points . " of " . $quest->skills()->sum('amount') . " points.";
                $notice->url = "quest/". $quest->id ."/feedback";
                $notice->course_id = session('current_course');
                $notice->save();
                Mail::send('emails.instructor_feedback', ['link' => $notice->url, 'sender' => $prof, 'feedback' => $request->feedback, 'quest' => $quest, 'total_points' => $total_points, 'sum_points' => $quest->skills()->sum('amount')], 
                    function ($message) use ($quest, $user, $prof) {
                        $message->subject($quest->name . " has been graded");
                        $message->from($prof->email, $prof->name);
                        $message->to($user->email);
                    });

            }

            return redirect()->route('grade.activity.select', $quest->course_id)
                                ->withFlashSuccess($quest->name . " graded for " . implode(",", $student_list) . ".");
        }
        

        return redirect()->route('grade.activity.select', $quest->course_id)
                                ->withFlashDanger("You must include students to be graded for a quest.");

    }


    public function activity_select($course_id) {
        $quests = Course::find($course_id)->quests()->where('quest_type_id', 2)->get();
        $users =  Course::find($course_id)
                        ->users()
                        ->where('user_id', '!=', access()->user()->id)
                        ->count();        
        return view('frontend.grade.activity_select', ['quests' => $quests, 'users' => $users, 'course_id' => $course_id])
            ->withUser(access()->user());
    }

    public function activity($quest_id) {
        $quest = Quest::find($quest_id);
        $students =  Course::find($quest->course_id)
                        ->users()
                        ->where('user_id', '!=', access()->user()->id)
                        ->whereNotIn('user_id', $quest->users()->pluck('user_id'))
                        ->get();
//        $quest->users()
        $skills = $quest->skills()->get();
        return view('frontend.grade.activity', ['quest' => $quest, 'skills' => $skills, 'students' => $students])
            ->withUser(access()->user());
    }
}
