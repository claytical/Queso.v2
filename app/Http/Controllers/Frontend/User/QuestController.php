<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return view('frontend.quests.available');
//            ->withUser(access()->user());
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

    public function submit() {
        return view('frontend.quests.submitted')
            ->withUser(access()->user());
    }

    public function revise_submission($quest_id) {
        return view('frontend.quests.revise_submission')
            ->withUser(access()->user());
    }

    public function completed() {
        return view('frontend.quests.completed')
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
