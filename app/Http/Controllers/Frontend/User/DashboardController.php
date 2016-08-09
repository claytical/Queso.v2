<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Announcement;
use App\Content;
use App\Course;
use App\Notice;
use DB;

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
        $notifications = Notice::where('user_id', '=', access()->user()->id)->get();
        $announcements = Announcement::where('course_id', '=', session('current_course'))->get();
        $course = Course::find(session('current_course'));
        return view('frontend.welcome', ['announcements' => $announcements,
                                            'course' => $course,
                                            'notifications' => $notifications])
                                            ->withUser(access()->user());
    }
    
    public function choose() {
        return view('frontend.user.choose')
            ->withUser(access()->user());

    }
}
