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
        $notifications = Notice::where('user_id', '=', $user->id)
                        ->whereNull('received')
//                      ->where('course_id', '=', session('current_course'))
                        ->get();
        $announcements = Announcement::where('course_id', '=', session('current_course'))->get();
        $course = Course::find(session('current_course'));
        $team = $user->teams()
                        ->where('team_user.course_id', session('current_course'))
                        ->where('team_user.user_id', '!=', $user->id)
                        ->get();
        $team_users = $team->users()->get();
        $total_points_earned = $user->skills()->sum('amount');
        $current_level = $course->levels()->where('amount', '<=', $total_points_earned)->orderBy('amount', 'desc')->first();
        return view('frontend.welcome', ['announcements' => $announcements,
                                          'current_level' => $current_level,
                                          'total_points' => $total_points_earned,
                                            'course' => $course,
                                            'notifications' => $notifications,
                                            'team_members' => $team_users])
                                            ->withUser(access()->user());
    }
    
    public function choose() {
        return view('frontend.user.choose')
            ->withUser(access()->user());

    }
}
