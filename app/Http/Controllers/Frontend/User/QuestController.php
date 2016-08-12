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
        $quests_attempted = $user->quests();
        $quests_attempted_ids = $quests_attempted->pluck('quest_id');

        $course_skills = Skill::where('course_id', '=', session('current_course'))->get();

//GET CURRENT SKILL LEVELS
        $user_skill_levels = array();
        foreach($course_skills as $skill) {
            $user_skill_levels[$skill->id] = $user->skills()->where('skill_id', $skill->id)->sum('amount');
        }

        $quests_unattempted = Quest::where('course_id', '=', session('current_course'))
                    ->whereNotIn('id', $quests_attempted_ids)
                    ->orderBy('expires_at')
                    ->get();
        $quests_revisable = Quest::where('course_id', '=', session('current_course'))
                    ->whereIn('id', $quests_attempted_ids)
                    ->where('revisions', '=', true)
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

    public function manage() {
        $quests = Quest::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.index', ['quests' => $quests])
            ->withUser(access()->user());

    }

    public function create_form() {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.new', ['skills' => $skills])
            ->withUser(access()->user());

    }


    public function edit_form($id) {
        $quest = Quest::find($id);
        $skills = $quest->skills()->get();
        $thresholds = $quest->thresholds()->with('skill')->get();
        $codes = $quest->redemption_codes()->get();
        return view('frontend.manage.quests.details', ['quest' => $quest, 
                                                        'skills' => $skills, 
                                                        'thresholds' => $thresholds,
                                                        'codes' => $codes])
            ->withUser(access()->user());

    }
    public function qrcodes() {
        return view('frontend.manage.quests.qrcodes')
            ->withUser(access()->user());

    }
    
    public function qrcards() {
        return view('frontend.manage.quests.qrcards')
            ->withUser(access()->user());

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
        $quest->instructions = $request->description;
        $quest->course_id = session('current_course');
        $quest->visible = true;
//category?
//color?        


//expirations
        if ($request->has('expiration')) {
            $quest->expires_at = $request->expiration;
        }
//file attachments

//type specific options
        switch($request->quest_type) {
            //SUBMISSION
            
            case '1':
                $quest->quest_type_id = 1;
                //feedback
                if ($request->has('feedback')) {
                    $quest->peer_feedback = true;
                }
                else {
                    $quest->peer_feedback = false;
                }
                //revisions
                if($request->has('revisions')) {
                    $quest->revisions = true;
                }
                else {
                    $quest->revisions = false;
                }
                //written
                if($request->has('submissions_allowed')) {
                    $quest->submissions = true;
                }
                else {
                    $quest->submissions = false;
                }

                //uploads
                if($request->has('uploads_allowed')) {
                    $quest->uploads = true;
                }
                else {
                    $quest->uploads = false;
                }

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

        $quest->save();

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

        return redirect()->route('quests.manage')->withFlashSuccess($quest->name . " has been successfully created.");

//        return view('frontend.manage.quests.created', ['data' => $request->all(), 'quest' => $quest])
//            ->withUser(access()->user());
    }
    public function attempt_submission($quest_id) {
        $quest = Quest::find($quest_id);
        $skills = $quest->skills()->get();
        return view('frontend.quests.attempt_submission', ['quest' => $quest, 'skills' => $skills])
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
        $user->quests()->attach($attempt->quest_id, ['revision' => $request->revision, 'graded' => false]);

        for($i = 0; $i < count($request->files); $i++) {
            $fid = $request->files[$i];
            $attempt->files()->attach($fid);
        }

        if($request->has('files')) {        
            return response()->json($request->files);
//                    return redirect()->route('frontend.user.dashboard')->withFlashSuccess($quest->name . " has been successfully submitted. Files " . count($request->files));
        }
        if ($request->revision > 0) {
            return redirect()->route('frontend.user.dashboard')->withFlashSuccess($quest->name . " has been successfully submitted.");
        }
        else {
            return redirect()->route('frontend.user.dashboard')->withFlashSuccess($quest->name . " has been successfully revised and submitted.");

        }

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
        
        if ($quest->quest_type_id == 1) {
            //submission
            $previous_attempt = Submission::where('quest_id', '=', $quest_id)
                                            ->where('user_id', '=', $user->id)
  //                                          ->where('graded', '=', true)
                                            ->orderBy('revision')
                                            ->first();
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

        return view('frontend.quests.attempt_revision', ['previous_attempt' => $previous_attempt, 'quest' => $quest, 'skills' => $skills, 'existing_skills' => $existing_skills, 'total' => $total_points])
            ->withUser(access()->user());
    }

    public function history() {
        $user = access()->user();
        
        $course = Course::find(session('current_course'));
        $course_skills = $course->skills()->get();
        $acquired_skills = [];
        foreach($course_skills as $skill) {
            $acquired_skills[] = ["amount" => $user->skills()->where('skill_id', $skill->id)->sum('amount'),
                                    "name" => $skill->name];
        }

        $total_points_earned = $user->skills()->sum('amount');
        $current_level = $course->levels()->where('amount', '<=', $total_points_earned)->orderBy('amount', 'desc')->first();
        $next_level = $course->levels()->where('amount', '>', $total_points_earned)->orderBy('amount', 'desc')->first();

        $percentage = ($total_points_earned / ($current_level->amount + $next_level->amount)) * 100;

        $quest_ids = $user->quests()->distinct()->select('quest_id')->orderBy('quest_user.created_at', 'asc')->pluck('quest_id');
        $quests = [];
        foreach($quest_ids as $id) {
            $quest = $user->quests()->where('quest_id', $id)->orderBy('quest_user.created_at');
            if ($quest->count() > 1) {
                $revisions = $quest->get();
            }
            else {
                $revisions = false;
            }

            $skills = $user->skills()->where('quest_id', $id)->get();
            $earned = $user->skills()->where('quest_id', $id)->sum('amount');
            $available = Quest::find($id)->skills()->sum('amount');
            $quests[] = ['quest' => $quest->first(), 'revisions' => $revisions, 'skills' => $skills,'earned' => $earned, 'available' => $available];
        }

        return view('frontend.quests.history', ['total_points' => $total_points_earned, 'quests' => $quests, 'current_level' => $current_level, 'next_level' => $next_level, 'percentage' => $percentage, 'skills' => $acquired_skills])
            ->withUser(access()->user());
    }

    public function view_feedback($quest_id) {
    	return view('frontend.quests.view_feedback')
    		->withUser(access()->user());
    }

    public function give_feedback($submission_id) {
    	return view('frontend.quests.give_feedback')
    		->withUser(access()->user());

    }

    public function submit_feedback() {
    	return view('frontend.quests.feedback_submitted')
    		->withUser(access()->user());

    }

    public function feedback_overview() {
    	return view('frontend.quests.feedback_overview')
    		->withUser(access()->user());
    }


}
