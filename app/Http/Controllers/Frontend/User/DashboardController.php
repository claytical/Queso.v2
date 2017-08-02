<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Announcement;
use App\Content;
use App\Course;
use App\Notice;
use DB;
use App\Models\Access\User\User;
use App\FeedbackRequest;
use App\Quest;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $user = access()->user();
        if (session('current_course')) {
            if(session('current_course') != 0) {
                $course = Course::find(session('current_course'));
            }
            else {
                $course = Course::find($user->default_course_id);
                session()->put('current_course', $user->default_course_id);

            }
        }
        else {
            $course = Course::find($user->default_course_id);
            session()->put('current_course', $user->default_course_id);

        }

        $notifications = Notice::where('user_id', '=', $user->id)
                        ->whereNull('received')
                        ->get();

        $feedback_request_quest_ids = FeedbackRequest::distinct()
                                                ->select('quest_id')
                                                ->where('user_id', '=', $user->id)
                                                ->where('fulfilled', '=', false)
                                                ->pluck('quest_id');

        $quests_needing_feedback = Quest::whereIn('id', $feedback_request_quest_ids)->get();
        $feedback = [];

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
            $feedback[] = $feedback_request;
            
        }

        $announcements = Announcement::where('course_id', '=', session('current_course'))
                                    ->where('sticky', '=', true)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        $total_points_earned = $user->skills()->sum('amount');
        if(!$total_points_earned) {
            $total_points_earned = 0;
        }
        if($course) {
            $current_level = $course->levels()->where('amount', '<=', $total_points_earned)->orderBy('amount', 'desc')->first();
        }
        else {
            return redirect(route('frontend.user.choose'));
        }
    
        return view('frontend.welcome', ['announcements' => $announcements,
                                          'current_level' => $current_level,
                                          'total_points' => $total_points_earned,
                                            'course' => $course,
                                            'notifications' => $notifications,
                                            'feedback_requests' => $feedback,
                                            'courses' => $user->courses()->active])
                                            ->withUser(access()->user());
    }
    
    public function choose() {
        return view('frontend.user.choose')
            ->withUser(access()->user());

    }
}
