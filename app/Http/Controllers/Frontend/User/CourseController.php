<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;
use App\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Skill;
use App\Level;
use App\Team;
use App\Models\Access\Role\Role;

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
//    	$course->description = $request->description;
    	$course->meeting = $request->meeting_time;
        $course->meeting_location = $request->meeting_location;
        $course->office_hours = $request->office_hours;
        $course->instructor_display_name = $request->instructor_display_name;
        $course->instructor_office_location = $request->instructor_office_location;
        $course->instructor_contact = $request->instructor_contact;

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
        
        $permission_model          		= config('access.permission');
        $coursePermission               = new $permission_model;
        $coursePermission->name         = 'course-'.$course->id;
        $coursePermission->display_name = $course->name;
        $coursePermission->sort         = 999;
        $coursePermission->created_at   = Carbon::now();
        $coursePermission->updated_at   = Carbon::now();
        $coursePermission->save();
		
		//Add course-instructor permission

        $course_instructorPermission               = new $permission_model;
        $course_instructorPermission->name         = 'course-'.$course->id.'-instructor';
        $course_instructorPermission->display_name = $course->name . " Instructor";
        $course_instructorPermission->sort         = 999;
        $course_instructorPermission->created_at   = Carbon::now();
        $course_instructorPermission->updated_at   = Carbon::now();
        $course_instructorPermission->save();

        $role = new Role;
        $role->name = $course->name . " Student ";
        $role->all = false;
        $role->save();
        $role->permissions()->sync([$coursePermission->id]);
        $course->student_role_id = $role->id;

        $role = new Role;
        $role->name = $course->name . " Instructor";
        $role->all = false;
        $role->save();
        $role->permissions()->sync([$course_instructorPermission->id, $coursePermission->id]);
        
        $course->instructor_role_id = $role->id;
        $course->save();

        $user->attachRole($role->id);

        //save course_id as current course session
        $request->session()->put('current_course', $course->id);

    	return redirect()->route('course.add.skills');
    	
    }

    public function add_skills() {
    	
    	$skills = Course::find(session('current_course'))->skills;
        return view('frontend.manage.course.skills', ['skills' => $skills])
            ->withUser(access()->user());
    
    }

    public function add_skill(Request $request) {
    
    	$skill = new Skill;
    	$skill->name = $request->skill;
    	$skill->course_id = $request->session()->get('current_course');
    	$skill->save();
		return redirect(route('course.add.skills'));

//    	return response()->json($skill);
    
    }

    public function remove_skill(Request $request) {
    	Skill::find($request->skill)->delete();
		return redirect(route('course.add.skills'));

    }

    public function remove_skill_ajax($id) {
        $skill = Skill::find($id);
        if ($skill) {
            if($skill->course->id == session('current_course') && access()->instructor()) {
                return response()->json(["success" => true]);
            }
        }
        return response()->json(["success" => false]);
    }


    public function edit_skill(Request $request) {
        $skill = Skill::find($request->skill_id);
        $skill->name = $request->skill;
        $skill->save();
        return response()->json($skill);
//        return redirect(route('course.manage'));
    }

    public function edit_level(Request $request) {
        $level = Level::find($request->level_id);
        $level->name = $request->level;
        $level->amount = $request->amount;
        $level->save();
        return redirect(route('course.manage'));
    }


    public function add_team(Request $request) {
    	$team = new Team;
    	$team->name = $request->team;
        $team->course_id = session('current_course');
    	$team->save();
		return redirect(route('course.manage'));
    }

    public function remove_team(Request $request) {
    	$team = Team::find($request->team_id);
    	$team->delete();
    	return redirect(route('course.manage'));
    }

    public function add_levels() {
    	$levels = Course::find(session('current_course'))->levels;
        return view('frontend.manage.course.levels', ['levels' => $levels])
            ->withUser(access()->user());

    }
    public function add_level(Request $request) {

    	$level = new Level;
    	$level->name = $request->level;
    	$level->amount = $request->amount;
    	$level->course_id = $request->session()->get('current_course');
    	$level->save();
		return redirect(route('course.add.levels'));

//    	return response()->json($level);
    
    }

    public function remove_level(Request $request) {
    	Level::find($request->level)->delete();
		return redirect(route('course.add.levels'));

    }
    public function add_level_m(Request $request) {

    	$level = new Level;
    	$level->name = $request->level;
    	$level->amount = $request->amount;
    	$level->course_id = $request->session()->get('current_course');
    	$level->save();
		return redirect(route('course.manage'));

//    	return response()->json($level);
    
    }

    public function add_skill_m(Request $request) {
    
    	$skill = new Skill;
    	$skill->name = $request->skill;
    	$skill->course_id = $request->session()->get('current_course');
    	$skill->save();
		return redirect(route('course.manage'));

//    	return response()->json($skill);
    
    }

    public function remove_skill_m(Request $request) {
    	Skill::find($request->skill)->delete();
		return redirect(route('course.manage'));

    }
    public function remove_level_m(Request $request) {
    	Level::find($request->level)->delete();
		return redirect(route('course.manage'));

    }



    public function instructions() {
        return view('frontend.manage.course.instructions')
            ->withUser(access()->user());

    }
    public function change($course_id) {
        $user = access()->user();
        if ($user->courses()->where('id', '=', $course_id)->count() == 1) {
            $course = Course::find($course_id);
            session()->put('current_course', $course_id);
            return redirect()->route('frontend.user.dashboard')->withFlashSuccess("Switched to " . $course->name);

        }
        else {
            return redirect()->route('frontend.user.dashboard')->withFlashDanger("Can't switch to that course.");

        }
    
    }
    public function join(Request $request) {
    	//redirect to dashboard with message
        $course = Course::where('code', '=', $request->registration_code);
        if($course->count() == 1) {
            //join course
            $joined_course = $course->first();
            $user = access()->user();
            $user->default_course_id = $joined_course->id;
            //ADD COURSE TO USER'S COURSE LIST
            $user->courses()->attach($joined_course->id);
            $user->attachRole($joined_course->student_role_id);
            $user->save();
            $request->session()->put('current_course', $joined_course->id);

            return redirect()->route('frontend.user.dashboard');
        }
        else if($course->count() > 1) {
            //return list of available courses
            return view('frontend.manage.course.joinlist', ['courses' => $course->get()])
                         ->withUser(access()->user());

        }
        else {
            //return course doesn't exist
            return redirect()->route('course.register')->withFlashDanger("The code provided (". $request->registration_code . ") is not valid.");

        }

    }

    public function register() {
        return view('frontend.manage.course.register')
            ->withUser(access()->user());

    }

    public function manage() {
    	$course = Course::find(session('current_course'));
    	$skills = $course->skills;
    	$levels = $course->levels;
    	$teams = $course->teams;
        return view('frontend.manage.course.details', ['course' => $course, 'skills' => $skills, 'levels' => $levels, 'teams' => $teams])
            ->withUser(access()->user());

    }

    public function update(Request $request) {
    	$course = Course::find(session('current_course'));
    	$course->name = $request->name;
    	$course->code = $request->reg_code;
    	$course->meeting = $request->meeting_time;
        $course->meeting_location = $request->meeting_location;
        $course->office_hours = $request->office_hours;
        $course->instructor_display_name = $request->instructor_display_name;
        $course->instructor_office_location = $request->instructor_office_location;
        $course->instructor_contact = $request->instructor_contact;
        
    	$course->save();
    	return redirect(route('course.manage'));

    }

}
