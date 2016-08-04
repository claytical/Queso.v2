<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinelab\Http\Client as HttpClient;
use App\Quest;
use App\Skill;
use App\Threshold;

/**
 * Class QuestController
 * @package App\Http\Controllers\Frontend
 */
class QuestController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function available()
    {
        return view('frontend.quests.available')
            ->withUser(access()->user());
    }

    public function manage() {
        return view('frontend.manage.quests.index')
            ->withUser(access()->user());

    }

    public function create_form() {
        $skills = Skill::where('course_id', '=', session('current_course'))->get();
        return view('frontend.manage.quests.new', ['skills' => $skills])
            ->withUser(access()->user());

    }


    public function edit_form() {
        return view('frontend.manage.quests.details')
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

    public function update() {
        return view('frontend.manage.quests.updated')
            ->withUser(access()->user());

    }
    public function delete() {
        return view('frontend.manage.quests.deleted')
            ->withUser(access()->user());
    }

    public function clone_form() {
        return view('frontend.manage.quests.clone')
            ->withUser(access()->user());

    }

   public function clone() {
        return view('frontend.manage.quests.cloned')
            ->withUser(access()->user());

    }


    public function create(Request $request) {
        return view('frontend.manage.quests.created', ['data' => $request->all()])
            ->withUser(access()->user());
    }
    public function attempt_submission($quest_id) {
        return view('frontend.quests.attempt_submission')
            ->withUser(access()->user());
    }
    
    public function watch_video($quest_id) {
        return view('frontend.quests.watch')
            ->withUser(access()->user());
    }

    public function attempt_link($quest_id) {
        return view('frontend.quests.attempt_link')
            ->withUser(access()->user());
    }

    public function submit(Request $request) {
        $quest = new Quest;
        $quest->name = $request->quest_title;
        $quest->instructions = $request->description;
        $quest->course_id = session('current_course');
        $quest->visible = true;
//category?
//color?        


//expirations
        if ($request->has('expiration_date')) {
//            $quest->expires_at
        }
//file attachments

//type specific options
        switch($request->quest_type_id) {
            //SUBMISSION
            /*
            case '1':
                $quest->quest_type_id = 1;
                //feedback
                if ($request->has('feedback_option')) {
                    $quest->peer_feedback = true;
                }
                else {
                    $quest->peer_feedback = false;
                }
                //revisions
                if($request->has('revisions_option')) {
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
                if($request->has('uploads_allowed') {
                    $quest->uploads = true;
                }
                else {
                    $quest->uploads = false;
                }

                break;
*/
            //IN CLASS
            case '2':
                $quest->quest_type_id = 2;

                if($request->instant_option == 1) {
                    $quest->instant = true;
                }
                else {
                    $quest->instant = false;
                }
                break;
            //WATCH VIDEO
            case '3':
                $quest->quest_type_id = 3;

                $quest->youtube_id = $request->video_url;
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

                break;
            default:
                break;

        }

        $quest->save();

//skills
        for($i = 0; $i < count($request->skill); $i++) {
            $skill_id = $request->skill_id[$i];
            if ($request->skill[$skill_id] > 0) {
                //INSERT QUEST SKILL
                $quest->skills()->attach($skill_id, ['amount' => $request->skill[$skill_id]]);                
            }
        }
//thresholds
        for($i = 0; $i < count($request->threshold); $i++) {
            $threshold_skill_id = $request->threshold_skill_id[$i];
            if ($request->threshold[$threshold_skill_id] > 0) {
                //INSERT QUEST SKILL THRESHOLD
                $threshold = new Threshold;
                $threshold->quest_id = $quest->id;
                $threshold->skill_id = $threshold_skill_id;
                $threshold->amount = $request->threshold[$threshold_skill_id];
                $threshold->save();
            }
        }        

        return view('frontend.quests.submitted', ['data' => $request->all(), 'quest' => $quest])
                ->withUser(access()->user());
    
    }

    public function redeem() {
        return view('frontend.quests.redeem')
            ->withUser(access()->user());
    }

    public function redeemed() {
        return view('frontend.quests.redeemed')
            ->withUser(access()->user());
    }

    public function revise() {
        return view('frontend.quests.revised')
            ->withUser(access()->user());
    }
    
    public function watched() {
        return view('frontend.quests.watched')
            ->withUser(access()->user());
    }
    public function revise_submission($quest_id) {
        return view('frontend.quests.revise_submission')
            ->withUser(access()->user());
    }

    public function history() {
        return view('frontend.quests.history')
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
