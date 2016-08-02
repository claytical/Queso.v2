<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Announcement;
use App\Content;
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
    public function index()
    {
        $resource_categories = Content::distinct()->whereNotNull('tag')
                                ->where('course_id', '=', session('current_course'))
                                ->get(['tag']);

        $resources = array();
        foreach($resource_categories as $tag) {
            $multi_resources = Content::where('tag', '=', $tag)
                                    ->where('course_id', '=', session('current_course'))
                                    ->get();
            $resources[] = ["category" => $tag, "resources" => $multi_resources];
        }

        $single_resources = Content::whereNull('tag')
                                    ->where('course_id', '=', session('current_course'))
                                    ->get();

        $announcements = Announcement::where('course_id', '=', session('current_course'))->get();
        return view('frontend.welcome', ['announcements' => $announcements, 
                                        'single_resources' => $single_resources,
                                        'multi_resources' => $resources])
                                ->withUser(access()->user());
    }
    
    public function choose() {
        return view('frontend.user.choose')
            ->withUser(access()->user());

    }
}
