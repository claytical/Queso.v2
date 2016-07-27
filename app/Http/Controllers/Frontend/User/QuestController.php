<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vinelab\Http\Client as HttpClient;

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

    public function submit(Request $request) {
        if($request->quest_type == "link") {
            $client = new HttpClient;
            $response = $client->get("http://iframe.ly/api/oembed?url=" . urlencode($request->link) . "&api_key=a705fe8012d914a446d7e4");
            return view('frontend.quests.submitted', ['data' => $response->json()])
                ->withUser(access()->user());
        }

        return view('frontend.quests.submitted', ['data' => $request->all()])
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
