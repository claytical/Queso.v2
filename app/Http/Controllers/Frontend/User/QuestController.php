<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinelab\Http\Client as HttpClient;
use App\Quest;
use App\Skill;
use App\Threshold;
use App\Link;
use App\Submission;
use Validator;
use App\Redemption;
use App\Level;
use App\Course;
use App\Models\Access\User\User;
use App\FeedbackRequest;
use App\Feedback;
use Carbon\Carbon;
use App\Notice;
use App\GroupQuest;
use DB;
use Mail;

/**
 * Class QuestController
 * @package App\Http\Controllers\Frontend
 */
class QuestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function available() {
//this only catches graded quests, 
        $user = access()->user();
        $course = Course::find(session('current_course'));
        $quests_attempted = $user->quests();
        $quests_attempted_ids = $quests_attempted->pluck('quest_id');

        $course_skills = Skill::where('course_id', '=', session('current_course'))->get();

//GET CURRENT SKILL LEVELS
        $user_skill_levels = array();
        foreach($course_skills as $skill) {
            $user_skill_levels[$skill->id] = $user->skills()->where('skill_id', $skill->id)->sum('amount');
        }

        $group_quests_attempted = $user->group_quests()->with('quest')->get();

        $group_quests_attempted_ids = $group_quests_attempted->pluck('quest_id');

        $group_quests = Quest::where('course_id', '=', session('current_course'))
                            ->where('groups', '=', true)
                            ->whereNotIn('id', $group_quests_attempted_ids)
                            ->get();

        if($course->timezone) {
			$timezone = $course->timezone;        	
        }
        else {
        	$timezone = "America/New_York";
        }

        $quests_unattempted_expiring = Quest::where('course_id', '=', session('current_course'))
                    ->whereNotIn('id', $quests_attempted_ids)
                    ->where('expires_at', '>', Carbon::now(new \DateTimeZone($timezone))->subDay())
                    ->where('groups', '=', false)
                    ->orderBy('expires_at')
                    ->get();

        $quests_unattempted_not_expiring = Quest::where('course_id', '=', session('current_course'))
                    ->whereNotIn('id', $quests_attempted_ids)
                    ->where('groups', '=', false)
                    ->whereNull('expires_at')
                    ->orderBy('name')
                    ->get();

        $quests_unattempted = $quests_unattempted_expiring->merge($quests_unattempted_not_expiring);

        $quests_unattempted = $quests_unattempted->merge($group_quests);

//TODO: Check if max points have been achieved
        $quests_revisable = Quest::where('course_id', '=', session('current_course'))
                    ->whereIn('id', $quests_attempted_ids)
                    ->where('revisions', '=', true)
                    ->where('groups', '=', false)                    
                    ->orderBy('expires_at')
                    ->get();

        $quests_locked = array();
        $quests_unlocked = array();

        foreach($quests_unattempted as $quest) {
            $thresholds = $quest->thresholds()->get();
            $met = true;
            foreach($thresholds as $threshold) {
                if($threshold->amount > $user_skill_levels[$threshold->skill_id]) {
                    $met = false;
                }
            }
            if($met) {
                $quests_unlocked[] = $quest;
            }
            else {
                $quests_locked[] = $quest;
            }
        }

        return view('frontend.quests.available', ['unlocked' => $quests_unlocked, 'locked' => $quests_locked, 'revisable' => $quests_revisable])
            ->withUser(access()->user());
    }

    public function manage($course_id) {
        $quests = Quest::where('course_id', '=', $course_id)->get();
        return view('frontend.manage.quests.index', ['quests' => $quests, 'course_id' => $course_id])
            ->withUser(access()->user());

    }

    public function choose($course_id) {
        return view('frontend.manage.quests.choose', ['course_id' => $course_id])
            ->withUser(access()->user());

    }

    public function create_response_form($course_id) {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.create.response', ['skills' => $skills, 'course_id' => $course_id])
            ->withUser(access()->user());

    }

    public function create_submission_form($course_id) {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.create.submission', ['skills' => $skills])
            ->withUser(access()->user());

    }
    public function create_group_submission_form($course_id) {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.create', ['skills' => $skills])
            ->withUser(access()->user());

    }
    public function create_activity_form($course_id) {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.create', ['skills' => $skills])
            ->withUser(access()->user());

    }

    public function create_video_form($course_id) {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.create', ['skills' => $skills])
            ->withUser(access()->user());

    }

    public function create_form() {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.create', ['skills' => $skills])
            ->withUser(access()->user());

    }


    public function edit_form($id) {
        $quest = Quest::find($id);
        $skills = $quest->skills()->get();
        $thresholds = $quest->thresholds()->with('skill')->get();
        $codes = $quest->redemption_codes()->get();
        $files = $quest->files;
        return view('frontend.manage.quests.details', ['quest' => $quest, 
                                                        'skills' => $skills, 
                                                        'thresholds' => $thresholds,
                                                        'codes' => $codes,
                                                        'files' => $files])
            ->withUser(access()->user());

    }
    public function generate_qrcodes(Request $request) {
            if($request->new_codes > 0) {
                for ($i = 0; $i < $request->new_codes; $i++) {
                    $code = new Redemption;
                    $code->quest_id = $request->quest_id;
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($j = 0; $j < 10; $j++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $code->code = $randomString;
                    $code->save();
                }
            }
            return redirect()->route('quests.qrcodes', [$request->quest_id])->withFlashSuccess("Added " . $request->new_codes . " new redemption codes.");

    }

    public function qrcodes($quest_id) {
        $quest = Quest::find($quest_id);
        $used_codes = Redemption::where('quest_id', '=', $quest_id)
                                    ->whereNotNull('user_id')
                                    ->get();

        $unused_codes = Redemption::where('quest_id', '=', $quest_id)
                                    ->whereNull('user_id')
                                    ->get();

        return view('frontend.manage.quests.qrcodes', ['quest' => $quest, 'unused_codes' => $unused_codes, 'used_codes' => $used_codes]);

    }
    
    public function qrcards($quest_id) {
        $quest = Quest::find($quest_id);
        $codes = Redemption::where('quest_id', '=', $quest_id)
                                ->get();
        if($codes) {
            return view('frontend.manage.quests.qrcards', ['quest' => $quest, 'codes' => $codes]);
        }
        else {
            return redirect()->route('quests.manage')->withFlashSuccess($quest->name . " has been successfully updated");

        }

    }

    public function show() {
        return view('frontend.manage.quests.show')
            ->withUser(access()->user());

    }
    public function hide() {
        return view('frontend.manage.quests.hide')
            ->withUser(access()->user());

    }

    public function update(Request $request) {
        $quest = Quest::find($request->id);
        $quest->name = $request->name;
        $quest->instructions = $request->description;
        if($request->has('expiration')) {
            $quest->expires_at = $request->expiration;
        }
        else {
            $quest->expires_at = null;
        }
        if($request->has('youtube_url')) {
                if (strpos($request->youtube_url, 'youtube.com') !== false) {
                    $youtube_url = [];
                    $yid = parse_str( parse_url( $request->video_url, PHP_URL_QUERY ), $youtube_url );
                    $quest->youtube_id = $youtube_url['v'];
                }
                else {
                    $quest->youtube_id = $request->youtube_url;
                }
        }

        $quest->instant = $request->has('instant');
        $quest->groups = $request->has('group_submission');
        
        if($quest->instant) {
            if($request->new_codes > 0) {
                for ($i = 0; $i < $request->new_codes; $i++) {
                    $code = new Redemption;
                    $code->quest_id = $quest->id;
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($j = 0; $j < 10; $j++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $code->code = $randomString;
                    $code->save();
                }
            }
        }
        $quest->peer_feedback = $request->has('peer_feedback');
        $quest->revisions = $request->has('revisions');

//UPDATE SKILLS
        for($i = 0; $i < count($request->skill); $i++) {
            $skill_id = $request->skill_id[$i];
            if (is_numeric($request->skill[$i])) {
                $quest->skills()->updateExistingPivot($skill_id, ['amount' => $request->skill[$i]]);
            }
        }

//UPDATE THRESHOLDS

       for($i = 0; $i < count($request->threshold); $i++) {
            $threshold_id = $request->threshold_id[$i];
            if (is_numeric($request->threshold[$i])) {
                $threshold = Threshold::find($threshold_id);
                $threshold->amount = $request->threshold[$i];
                $threshold->save();
            }
        }        
//FILES
        if($request->has('files')) {
            $files = $request->input('files');
            for($i = 0; $i < count($files); $i++) {
                $quest->files()->attach($files[$i]);
            }
        }


        $quest->save();
        //session->flash('flash_success', );
//        return view('frontend.manage.quests.updated')
        return redirect()->route('quests.manage')->withFlashSuccess($quest->name . " has been successfully updated");

  //          ->withUser(access()->user());

    }
    public function delete($id) {
        $quest = Quest::find($id);
        $quest->delete();
        return redirect()->route('quests.manage')->withFlashSuccess($quest->name . " has been removed");
/*
        return view('frontend.manage.quests.deleted')
            ->withUser(access()->user());
*/
    }

    public function clone_form($id) {
        $quest = Quest::find($id);
        $skills = $quest->skills()->get();
        $thresholds = $quest->thresholds()->with('skill')->get();

        return view('frontend.manage.quests.clone', ['quest' => $quest, 'skills' => $skills, 'thresholds' => $thresholds])
            ->withUser(access()->user());

    }

   public function clone() {
        return view('frontend.manage.quests.cloned')
            ->withUser(access()->user());

    }


    public function create(Request $request) {
        $quest = new Quest;
        $quest->name = $request->name;
        $quest->quest_type_id = $request->quest_type_id;
        $quest->instructions = $request->description;
        $quest->course_id = $request->course_id;
        $quest->submissions = $request->submissions_allowed;
        $quest->uploads_allowed = $request->uploads_allowed;
        $quest->groups = $request->groups;
        $quest->instant = $quest->instant;


        $quest->visible = true;
        switch($request->quest_type_id) {
            case '1':
                //individual written response

                //conditional expiration, feedback, revisions
                if($request->expires) {
                    $quest->expires_at = $request->expiration;
                }

                $quest->peer_feedback = $request->feedback;
                $quest->revisions = $request->revisions;

                break;
        }    

        $quest->save();

        //RESPONSE FORM

//category?
//color?        


//file attachments

//type specific options
        /*
        switch($request->quest_type) {
            //SUBMISSION
            
            case '1':


                break;

            //IN CLASS
            case '2':
                $quest->quest_type_id = 2;

                if($request->has('instant')) {
                    $quest->instant = true;
                }
                else {
                    $quest->instant = false;
                }
                break;
            //WATCH VIDEO
            case '3':
                $quest->quest_type_id = 3;
                if (strpos($request->video_url, 'youtube.com') !== false) {
                    $youtube_url = [];
                    $yid = parse_str( parse_url( $request->video_url, PHP_URL_QUERY ), $youtube_url );
                    $quest->youtube_id = $youtube_url['v'];
                }
                else {
                    //give error
                    return redirect()->route('quests.manage')->withFlashDanger("This feature requires a YouTube URL.");
                }
                break;
            //LINK
            case '4':
                $quest->quest_type_id = 4;
                //feedback
                if ($request->has('feedback_option')) {
                    $quest->peer_feedback = true;
                }
                else {
                    $quest->peer_feedback = false;
                }
                if($request->has('revisions')) {
                    $quest->revisions = true;
                }
                else {
                    $quest->revisions = false;
                }

                break;
            
            default:
                break;

        }

        */

//skills
        for($i = 0; $i < count($request->skill); $i++) {
            $skill_id = $request->skill_id[$i];
            if (is_numeric($request->skill[$i])) {
                //INSERT QUEST SKILL
                $quest->skills()->attach($skill_id, ['amount' => $request->skill[$i]]);                
            }
        }
//thresholds
        for($i = 0; $i < count($request->threshold); $i++) {
            $threshold_skill_id = $request->threshold_skill_id[$i];
            if (is_numeric($request->threshold[$i])) {
                //INSERT QUEST SKILL THRESHOLD
                $threshold = new Threshold;
                $threshold->quest_id = $quest->id;
                $threshold->skill_id = $threshold_skill_id;
                $threshold->amount = $request->threshold[$i];
                $threshold->save();
            }
        }     

//files
        if($request->has('files')) {
            $files = $request->input('files');
            for($i = 0; $i < count($files); $i++) {
                $quest->files()->attach($files[$i]);
            }
        }



        return redirect()->route('quests.manage')->withFlashSuccess($quest->name . " has been successfully created.");

//        return view('frontend.manage.quests.created', ['data' => $request->all(), 'quest' => $quest])
//            ->withUser(access()->user());
    }
    public function attempt_submission($quest_id) {
        $quest = Quest::find($quest_id);
        $skills = $quest->skills()->get();
        $files = $quest->files;
        return view('frontend.quests.attempt_submission', ['quest' => $quest, 'skills' => $skills, 'files' => $files])
            ->withUser(access()->user());
    }
    
    public function watch_video($quest_id) {
        $quest = Quest::find($quest_id);
        $skills = $quest->skills()->get();
        return view('frontend.quests.watch', ['quest' => $quest, 'skills' => $skills])
            ->withUser(access()->user());
    }

    public function attempt_link($quest_id) {
        $quest = Quest::find($quest_id);
        $skills = $quest->skills()->get();
        return view('frontend.quests.attempt_link', ['quest' => $quest, 'skills' => $skills])
            ->withUser(access()->user());
    }

    public function submit(Request $request) {
        $quest = Quest::find($request->quest_id);
        $user = access()->user();
        if($request->revision > 0) {
            //CHECK IF UNGRADED
            $ungraded_quests = $user->quests()->where('quest_id', $request->quest_id)->where('graded', false);
            if ($ungraded_quests->count() > 0) {
                if($ungraded_quests->first()->quest_type_id == 1) {
                    Submission::where('quest_id', '=', $request->quest_id)
                                ->where('user_id', '=', $user->id)
                                ->delete();
                }
                else {
                    Link::where('quest_id', '=', $request->quest_id)
                            ->where('user_id', '=', $user->id)
                            ->delete();
                }
                $ungraded_quests->detach();

            }

        }
        if($quest->quest_type_id == 1) {
            $attempt = new Submission;
            if($quest->submissions) {
                $attempt->submission = $request->submission;
            }

        }

        if($quest->quest_type_id == 4) {
            $validator = Validator::make(
                ['link' => $request->link],
                ['link' => 'url']
            );
            
            if ($validator->fails()) {
                // The given data did not pass validation
                return redirect()->route('frontend.user.dashboard')->withFlashDanger("Link for . " . $quest->name . " is invalid.");
            }

            $attempt = new Link;
            $attempt->url = $request->link;
        }

        $user = access()->user();



        $attempt->quest_id = $request->quest_id;
        $attempt->user_id = $user->id;
        $attempt->revision = $request->revision;
        $attempt->save();

        if($quest->groups) {
            //GROUP QUEST
            $gq = new GroupQuest;
            $gq->quest_id = $attempt->quest_id;
            $gq->attempt_id = $attempt->id;
            $gq->save();
            $gq->users()->attach($user->id);
            for($i = 0; $i < count($request->students); $i++) {
                if (is_numeric($request->students[$i])) {
                    //add to group quest user
                    $gq->users()->attach($request->students[$i]);
//                        $user->skills()->attach($skill->id, ['amount' => $skill->pivot->amount, 'quest_id' => $quest->id]);
                    $notice = new Notice;
                    $notice->user_id = $request->students[$i];
                    $notice->message = $quest->name . " has been submitted for your group by ". $user->name;
                    $notice->url = null;
                    $notice->course_id = session('current_course');
                    $notice->save();

              }
            }

        } else {
            $user->quests()->attach($attempt->quest_id, ['revision' => $request->revision, 'graded' => false]);
        }

        if ($quest->peer_feedback) {
            $team = $user->teams()->where('team_user.course_id', session('current_course'))->first();
            if ($team) {
                $members = $team->users()->where('user_id', '!=', $user->id)->get();
                foreach($members as $member) {
                    //SEND FEEDBACK REQUEST
                    $feedback_request = new FeedbackRequest;
                    $feedback_request->user_id = $member->id;
                    $feedback_request->from_user_id = $user->id;
                    $feedback_request->quest_id = $quest->id;
                    $feedback_request->revision = $request->revision;
                    $feedback_request->course_id = session('current_course');
                    $feedback_request->fulfilled = false;
                    $feedback_request->save();

                }
            }
        }

        if($request->has('files')) {
            $files = $request->input('files');
            for($i = 0; $i < count($files); $i++) {
                $attempt->files()->attach($files[$i]);
            }
        }
        $instructors = access()->course_instructors();
        foreach($instructors as $instructor) {
            $notice = new Notice;
            $notice->user_id = $instructor->id;
            $notice->message = $user->name . " has submitted " . $quest->name;
            $notice->url = "grade/quest/". $quest->id ."/" . $attempt->id;
            $notice->course_id = session('current_course');
            $notice->save();

            Mail::send('emails.quest_submitted', ['link' => $notice->url, 'student' => $user->name, 'quest' => $quest, 'attempt' => $attempt], 
                function ($message) use ($quest, $user, $instructor) {
                $message->subject($quest->name . " has been submitted.");
                $message->from($user->email, $user->name);
                $message->to($instructor->email);
            });
        }
        if ($request->revision == 0) {
            return redirect()->route('frontend.user.dashboard')->withFlashSuccess($quest->name . " has been successfully submitted. ");
        }
        else {
            return redirect()->route('frontend.user.dashboard')->withFlashSuccess($quest->name . " has been successfully revised and submitted.");

        }

    }
    public function remove_student_attempt($student_id, $quest_id) {
        $quest = Quest::find($quest_id);
        $user = User::find($student_id);
        if($quest->groups) {

            $gq = $user->group_quests()->where('quest_id', $quest_id)->first();
            $attempt_id = $gq->attempt_id;
            if($quest->quest_type_id == 1) {
                $attempt = Submission::find($attempt_id);
                if($attempt) {
                    $attempt->delete();
                }   
            }
            if($quest->quest_type_id == 4) {
                $attempt = Link::find($attempt_id);
                if($attempt) {
                    $attempt->delete();
                }
            }
            $gq = $user->group_quests()->detach($quest_id);
        }
        else {
            $user->quests()->detach($quest_id);
        }

        DB::table('skill_user')
            ->where('quest_id', '=', $quest_id)
            ->where('user_id', '=', $user->id)
            ->delete();

        return redirect()->route('student.detail', ['student_id' => $student_id])
                            ->withFlashSuccess("Removed " . $quest->name . " from student.");        
    }

    public function redeem() {
        return view('frontend.quests.redeem')
            ->withUser(access()->user());
    }

    public function redeemed(Request $request) {
        $user = access()->user();
        $instant = Redemption::where('code', '=', $request->code)
                                ->whereNull('user_id');
        if ($instant->count() == 0) {
            //bad code
            return redirect()->route('quest.redeem')
                            ->withFlashDanger("Invalid instant code!");

        }
        $redeemed = $instant->first();
        $redeemed->user_id = $user->id;
        $redeemed->save();
        $quest = Quest::find($redeemed->quest_id);
        $skills = $quest->skills()->get();
        $total_points = 0;
        foreach($skills as $skill) {
            $user->skills()->attach($skill->id, ['amount' => $skill->pivot->amount, 'quest_id' => $quest->id]);
            $total_points += $skill->pivot->amount;

        }

        $user->quests()->attach($quest->id, ['graded' => true, 'revision' => 0]);
        return redirect()->route('frontend.user.dashboard')
                            ->withFlashSuccess("Received " . $total_points . " points for " . $quest->name . ".");

        return view('frontend.quests.redeemed')
            ->withUser(access()->user());
    }

    public function revise() {
        return view('frontend.quests.revised')
            ->withUser(access()->user());
    }
    

    public function revise_submission($quest_id) {
        $quest = Quest::find($quest_id);
        $user = access()->user();
        $skills = $quest->skills()->get();
        $files = false;

        $instructor_feedback = Feedback::where('quest_id', '=', $quest_id)
                                        ->where('to_user_id', $user->id)
                                        ->where('subtype', '=', 1)
                                        ->orderBy('revision')
                                        ->get();

        $positive_feedback = Feedback::where('quest_id', '=', $quest_id)
                                        ->where('to_user_id', $user->id)
                                        ->where('subtype', '=', 2)
                                        ->orderBy('revision')  
                                        ->get();

        $negative_feedback = Feedback::where('quest_id', '=', $quest_id)
                                        ->where('to_user_id', $user->id)
                                        ->where('subtype', '=', 3)
                                        ->orderBy('revision')
                                        ->get();


        if ($quest->quest_type_id == 1) {
            //submission
            $previous_attempt = Submission::where('quest_id', '=', $quest_id)
                                            ->where('user_id', '=', $user->id)
  //                                          ->where('graded', '=', true)
                                            ->orderBy('revision')
                                            ->first();
            $files = $previous_attempt->files;
        }
        if ($quest->quest_type_id == 4) {
            //link
            $previous_attempt = Link::where('quest_id', '=', $quest_id)
                                            ->where('user_id', '=', $user->id)
//                                            ->where('graded', '=', true)
                                            ->orderBy('revision')
                                            ->first();
        }
        $existing_skills = $user->skills()
                                ->where('quest_id', $quest_id);
        $total_points = $existing_skills->sum('amount');

        $existing_skills = $existing_skills->get();

        return view('frontend.quests.attempt_revision', ['previous_attempt' => $previous_attempt, 'quest' => $quest, 'skills' => $skills, 'existing_skills' => $existing_skills, 'total' => $total_points, 'files' => $files, 'positive' => $positive_feedback, 'negative' => $negative_feedback, 'instructor_feedback' => $instructor_feedback])
            ->withUser(access()->user());
    }

    public function history() {
        $user = access()->user();
        
        $course = Course::find(session('current_course'));
        $course_skills = $course->skills()->get();
        $acquired_skills = [];

        foreach($course_skills as $skill) {
            $amount = $user->skills()
                            ->where('skill_id', $skill->id)
                            ->sum('amount');
            if(!$amount) {
                $amount = 0;
            }
            $acquired_skills[] = ["amount" => $amount,
                                    "name" => $skill->name];
        }

        $total_points_earned = $user->skills()->where('course_id', '=', session('current_course'))->sum('amount');

        if(!$total_points_earned) {
            $total_points_earned = 0;
        }

        $current_level = $course->levels()->where('amount', '<=', $total_points_earned)->orderBy('amount', 'desc')->first();
        $next_level = $course->levels()->where('amount', '>', $total_points_earned)->orderBy('amount', 'desc')->first();
        $levels = $course->levels()->orderBy('amount')->get();

        javascript()->put(['levels' => $levels]);
        if(!isset($current_level->amount) || !isset($next_level->amount)) {
            $percentage = 100;
        }
        else {
            $percentage = ($total_points_earned / ($current_level->amount + $next_level->amount)) * 100;
        }
        $quest_ids = $user->quests()
                            ->where('course_id', '=', session('current_course'))
                            ->distinct()
                            ->select('quest_id')
                            ->orderBy('quest_user.created_at', 'asc')
                            ->pluck('quest_id');

        $group_quest_ids = $user->group_quests()->pluck('quest_id');

        $all_quest_ids = $course->quests()
                            ->where('course_id', '=', session('current_course'))
                            ->whereIn('id', $group_quest_ids)
                            ->orWhereIn('id', $quest_ids)
                            ->distinct()
                            ->select('id')
                            ->pluck('id');




//        $all_quest_ids = array_merge($quest_ids,$more_ids);
 
        $quest_skills_total = 0;

        $quests = [];
        foreach($all_quest_ids as $id) {
            $q = Quest::find($id);
            if($q->groups) {
                $quest = DB::table('group_quest_users')
                                ->join('group_quest', 'group_quest_users.group_quest_id', '=', 'group_quest.id')
                                ->join('quests', 'group_quest.quest_id', '=', 'quests.id')
                                ->select('quests.name', 'quests.created_at', 'quests.instructions', 'quests.id')
                                ->where('user_id', '=', $user->id)
                                ->where('quest_id', '=', $id)
                                ->orderBy('group_quest.created_at');
            }
            else {
                $quest = $user->quests()->where('quest_id', $id)->orderBy('quest_user.created_at');
            }

            if ($quest->count() > 1) {
                $revisions = $quest->get();
            }
            else {
                $revisions = false;
            }

            $user_quest_skills = $user->skills()->where('quest_id', $id);
            if ($user_quest_skills->count() > 0) {
                $earned = $user_quest_skills->sum('amount');
            }
            else {
                $earned = false;

            }
            
            $skills = $user_quest_skills->get();
            $available = Quest::find($id)->skills()->sum('amount');
            $quest_skills_total += $available;
            $quests[] = ['quest' => $quest->first(), 'revisions' => $revisions, 'skills' => $skills,'earned' => $earned, 'available' => $available];
        }

        $quests_unattempted_expiring = Quest::where('course_id', '=', session('current_course'))
                    ->whereNotIn('id', $all_quest_ids)
                    ->where('expires_at', '>', Carbon::now(new \DateTimeZone($course->timezone))->subDay())
                    ->orderBy('expires_at')
                    ->get();

        $quests_unattempted_not_expiring = Quest::where('course_id', '=', session('current_course'))
                    ->whereNotIn('id', $all_quest_ids)
                    ->whereNull('expires_at')
                    ->orderBy('name')
                    ->get();

        $quests_unattempted = $quests_unattempted_expiring->merge($quests_unattempted_not_expiring);

        return view('frontend.quests.history', ['total_points' => $total_points_earned, 'total_potential' => $quest_skills_total, 'quests' => $quests, 'current_level' => $current_level, 'next_level' => $next_level, 'percentage' => $percentage, 'skills' => $acquired_skills, 'available_quests' => $quests_unattempted, 'idz' => $all_quest_ids])
            ->withUser(access()->user());
    }

    public function view_feedback($quest_id, $user_id = null) {
        $quest = Quest::find($quest_id);
        if($user_id) {
            $user = User::find($user_id);
        }
        else {
            $user = access()->user();
        }
        $skills = $user->skills()->where('quest_id', $quest_id)->get();
        $quest_skills = $quest->skills()->get();
        if($quest->groups) {
            $user_quest = DB::table('group_quest_users')
                                ->join('group_quest', 'group_quest_users.group_quest_id', '=', 'group_quest.id')
                                ->join('quests', 'group_quest.quest_id', '=', 'quests.id')
                                ->select('quests.name', 'quests.created_at', 'group_quest.graded', 'group_quest.attempt_id')
                                ->where('user_id', '=', $user->id)
                                ->where('quest_id', '=', $quest_id)
                                ->orderBy('group_quest.created_at')
                                ->first();
            $graded = $user_quest->graded;

        }
        else {
            $user_quest = $user->quests()->where('quest_id', $quest_id)->first();
            if($user_quest) {
                if ($user_quest->pivot->graded) {
                    $graded = true;
                }
                else {
                    $graded = false;
                }
            }
            else {
                $graded = false;
            }
        }
        $files = false;
        $attempt = null;
        if($quest->quest_type_id == 1) {
            if($quest->groups) {
                $attempt = Submission::find($user_quest->attempt_id);
            }
            else {
                $attempt = Submission::where('quest_id', '=', $quest_id)
                                            ->where('user_id', '=', $user->id)
                                            ->orderBy('revision')
                                            ->first();

            }            
            $files = $attempt->files;

        }
        if($quest->quest_type_id == 4) {
            if($quest->groups) {
                $attempt = Link::find($user_quest->attempt_id);
            }
            else {
            $attempt = Link::where('quest_id', '=', $quest->id)
                            ->where('user_id', '=', $user_id)
                            ->orderBy('revision')
                        //    ->where('revision', '=', $revision)
                            ->first();
            }
        }

        $instructor_feedback = Feedback::where('quest_id', '=', $quest->id)
                                        ->where('to_user_id', '=', $user->id)
                                        ->where('subtype', '=', 1)
                                        ->get();
        $positive_feedback = Feedback::where('quest_id', '=', $quest->id)
                                        ->where('to_user_id', '=', $user->id)
                                        ->where('subtype', '=', 2)
                                        ->get();

        $negative_feedback = Feedback::where('quest_id', '=', $quest->id)
                                        ->where('to_user_id', '=', $user->id)
                                        ->where('subtype', '=', 3)
                                        ->get();


    	return view('frontend.quests.view_feedback', ['student' => $user, 'quest' => $quest, 'positive' => $positive_feedback, 'negative' => $negative_feedback, 'attempt' => $attempt, 'files' => $files, 'graded' => $graded, 'skills' => $skills, 'quest_skills' => $quest_skills, 'instructor_feedback' => $instructor_feedback]);
    }

    public function give_feedback($quest_id, $user_id, $revision) {
        $quest = Quest::find($quest_id);
        $user = User::find($user_id);
        $files = false;
        if ($quest->quest_type_id == 1) {
            //SUBMISSION
            $attempt = Submission::where('quest_id', '=', $quest->id)
                                        ->where('user_id', '=', $user_id)
                                        ->where('revision', '=', $revision)
                                        ->first();
            
            $files = $attempt->files;
            
        }
        if ($quest->quest_type_id == 4) {
            //LINK
            $attempt = Link::where('quest_id', '=', $quest->id)
                                        ->where('user_id', '=', $user_id)
                                        ->where('revision', '=', $revision)
                                        ->first();
        }

    	return view('frontend.quests.give_feedback', ['quest' => $quest, 'attempt' => $attempt, 'user' => $user, 'files' => $files]);

    }

    public function submit_feedback(Request $request) {
        $quest = Quest::find($request->quest_id);
        $user = access()->user();
        $to_user = User::find($request->user_id);
        $feedback_positive = new Feedback;
        $feedback_positive->quest_id = $request->quest_id;
        $feedback_positive->to_user_id = $request->user_id;
        $feedback_positive->from_user_id = $user->id;
        $feedback_positive->revision = $request->revision;
        $feedback_positive->subtype = 2;
        $feedback_positive->note = $request->liked;
        $feedback_positive->save();

        $feedback_negative = new Feedback;
        $feedback_negative->quest_id = $request->quest_id;
        $feedback_negative->to_user_id = $request->user_id;
        $feedback_negative->from_user_id = $user->id;
        $feedback_negative->revision = $request->revision;
        $feedback_negative->subtype = 3;
        $feedback_negative->note = $request->suggestions;
        $feedback_negative->save();
        
        $feedback_request = FeedbackRequest::where('user_id', '=', $user->id)
                                            ->where('from_user_id', '=', $request->user_id)
                                            ->where('quest_id', '=', $request->quest_id)
                                            ->where('revision', '=', $request->revision)
                                            ->first();
        if($feedback_request) {
            $feedback_request->fulfilled = true;
            $feedback_request->save();
            //send notification to user
            $notice = new Notice;
            $notice->user_id = $request->user_id;
            $notice->message = $user->name . " has sent you feedback for " . $quest->name;
            $notice->url = "quest/". $quest->id ."/feedback";
            $notice->course_id = session('current_course');
            $notice->save();
            Mail::send('emails.feedback_sent', ['link' => $notice->url, 'sender' => $user->name, 'positive' => $feedback_positive, 'negative' => $feedback_negative, 'quest' => $quest], 
                function ($message) use ($quest, $user, $to_user) {
                $message->subject($quest->name . " has received feedback.");
                $message->from($user->email, $user->name);
                $message->to($to_user->email);
            });

            return redirect()->route('frontend.user.dashboard')->withFlashSuccess("Feedback has been sent.");

        }
        else {
            return redirect()->route('frontend.user.dashboard')->withFlashDanger("Error saving feedback.");

        }

    }

    public function feedback_overview() {
        $user = access()->user();
        $feedback_request_quest_ids = FeedbackRequest::distinct()
                                                ->select('quest_id')
                                                ->where('from_user_id', '=', $user->id)
                                                ->where('course_id', '=', session('current_course'))
                                                ->pluck('quest_id');

        $quests_with_feedback = Quest::whereIn('id', $feedback_request_quest_ids)->get();

        $feedback_received = [];

        foreach($quests_with_feedback as $quest) {
            //quest name, quest id, revision, sender name
            $feedback_request = new \stdClass;
            $feedback_request->quest_id = $quest->id;
            $feedback_request->quest_name = $quest->name;
            $request = FeedbackRequest::where('quest_id', '=', $quest->id)
                                        ->where('from_user_id', '=', $user->id);
            $feedback_request->fulfilled = $request->where('fulfilled', '=', true)->count();
            $feedback_request->pending = $request->where('fulfilled', '=', false)->count();
            $pending = $request->where('fulfilled', '=', false)->get();
            $requests = [];
            
            foreach($pending as $request) {
                $freq = new \stdClass;
                $freq->sender = $request->sender()->first();
            //    $freq->from_user_id = $request->from_user_id;
                $freq->revision = $request->revision;
                $requests[] = $freq;
            }
            $feedback_request->requests = $requests;
            $feedback_received[] = $feedback_request;
        }


        $feedback_request_quest_ids = FeedbackRequest::distinct()
                                                ->select('quest_id')
                                                ->where('user_id', '=', $user->id)
                                                ->where('course_id', '=', session('current_course'))
                                                ->where('fulfilled', '=', false)
                                                ->pluck('quest_id');

        $quests_needing_feedback = Quest::whereIn('id', $feedback_request_quest_ids)->get();
       
        $feedback_requested = [];

        foreach($quests_needing_feedback as $quest) {
            //quest name, quest id, revision, sender name
            $feedback_request = new \stdClass;
            $feedback_request->quest_id = $quest->id;
            $feedback_request->quest_name = $quest->name;
            $feedback_requests = FeedbackRequest::where('quest_id', '=', $quest->id)
                                                    ->where('user_id', '=', $user->id)
                                                    ->where('fulfilled', '=', false)
                                                    ->get();
            $requests = [];
            
            foreach($feedback_requests as $request) {
                $freq = new \stdClass;
                $freq->sender = $request->sender()->first();
                $freq->from_user_id = $request->from_user_id;
                $freq->revision = $request->revision;
                $requests[] = $freq;
            }
            $feedback_request->requests = $requests;
            $feedback_requested[] = $feedback_request;
            
        }


    	return view('frontend.quests.feedback_overview', ["feedback_requested" => $feedback_requested, "feedback_received" => $feedback_received])
    		->withUser(access()->user());
    }


}
