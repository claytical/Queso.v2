<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;
use App\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function create(Request $request) {
    	//CREATE COURSE
    	$course = new Course;
    	$course->name = $request->name;
    	$course->description = $request->description;
    	$course->meeting = $request->meeting_time;
    	if ($request->reg_code) {
    		$course->code = $request->reg_code;
		}
		else {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$charactersLength = strlen($characters);
    		$randomString = '';
    		for ($i = 0; $i < 6; $i++) {
        		$randomString .= $characters[rand(0, $charactersLength - 1)];
    		}
			$request->code = $randomString;
		}

		$course->active = true;
		$course->public = false;

		$course->save();
		//ADD DEFAULT COURSE ID FOR INSTRUCTOR
		$user = access()->user();
		$user->default_course_id = $course->id;
		//ADD COURSE TO USER'S COURSE LIST
		$user->courses()->attach($course->id);
		$user->save();
		
		//Add course-student permission
        
        $permission_model          = config('access.permission');
        $coursePermission               = new $permission_model;
        $coursePermission->name         = 'course-'.$course->id;
        $coursePermission->display_name = $course->name;
        $coursePermission->sort         = 999;
        $coursePermission->created_at   = Carbon::now();
        $coursePermission->updated_at   = Carbon::now();
        $coursePermission->save();
        $user->allow($coursePermission);
		
		//Add course-instructor permission

        $course_instructorPermission               = new $permission_model;
        $course_instructorPermission->name         = 'course-'.$course->id.'-instructor';
        $course_instructorPermission->display_name = $course->name . " Instructor";
        $course_instructorPermission->sort         = 999;
        $course_instructorPermission->created_at   = Carbon::now();
        $course_instructorPermission->updated_at   = Carbon::now();
        $course_instructorPermission->save();
        $user->allow($course_instructorPermission);

        //save course_id as current course session
        $request->session()->put('current_course', $course->id);

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
