<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class CourseController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create_form() {
    	return view('frontend.manage.course.create')
            ->withUser(access()->user());
    }

    public function create() {
		//TODO: Create new course
		//TODO: Set default_course_id
    	return redirect()->route('course.add.skills');
    }

    public function add_skills() {
        return view('frontend.manage.course.skills')
            ->withUser(access()->user());

    }

    public function add_levels() {
        return view('frontend.manage.course.levels')
            ->withUser(access()->user());

    }

    public function instructions() {
        return view('frontend.manage.course.instructions')
            ->withUser(access()->user());

    }

    public function join() {
    	//redirect to dashboard with message
    	return redirect()->route('frontend.user.dashboard');

    }

    public function register() {
        return view('frontend.manage.course.register')
            ->withUser(access()->user());

    }

    public function manage() {
        return view('frontend.manage.course.details')
            ->withUser(access()->user());

    }


}
