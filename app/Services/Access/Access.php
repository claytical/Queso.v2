<?php

namespace App\Services\Access;
use App\Course;
use App\Quest;
use Carbon\Carbon;
use App\Submission;
use App\Link;
use App\GroupQuest;


/**
 * Class Access
 * @package App\Services\Access
 */
class Access
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new confide instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get the currently authenticated user or null.
     */
    public function user()
    {
        return auth()->user();
    }

    /**
    *   Is student for current course?
    *   
    **/

    public function course() {
        if(session('current_course') == 0) {
            $course = Course::find($this->user()->default_course_id);            
        }
        else {
            $course = Course::find(session('current_course'));
        }

        return $course;        
    }

    public function contentCount() {
        if(session('current_course') == 0) {
            $course = Course::find($this->user()->default_course_id);
        }
        else {
            $course = Course::find(session('current_course'));
        }

       $content = $course->content()->count();
       return $content;
    }

    public function student() {
        if(session('current_course') == 0) {
            $course = Course::find($this->user()->default_course_id);
        }
        else {
            $course = Course::find(session('current_course'));
        }

        if ($user = $this->user()) {
            return $user->hasRole($course->student_role_id);
        }
    }
    public function instructor() {
        if(session('current_course') == 0) {
            $course = Course::find($this->user()->default_course_id);
        }
        else {
            $course = Course::find(session('current_course'));
        }
        if ($course) {
            if ($user = $this->user()) {
                return $user->hasRole($course->instructor_role_id);
            }
        }
        return false;
    }

    public function courses() {
        return $this->user()->courses;        
    }

    public function courses_taught() {
        $courses = $this->user()->courses;
        $teaching = array();

        foreach($courses as $course) {
            if($this->user()->hasRole($course->instructor_role_id)) {
                //Instructor
                $teaching[] = $course;                
            }

        }


        return $teaching;

    }

    public function courses_enrolled() {
        $courses = $this->user()->courses;
        $enrolled = array();

        foreach($courses as $course) {
            if($this->user()->hasRole($course->student_role_id)) {
                //Instructor
                $enrolled[] = $course;                
            }

        }


        return $enrolled;

    }


    public function course_instructors() {
        $course = Course::find(session('current_course'));
        $instructors = [];
        foreach($course->users as $user) {
            if($user->hasRole($course->instructor_role_id)) {
                $instructors[] = $user;
            }
        }
        return $instructors;
    }


    public function awaiting_grade() {
        $courses = $this->user()->courses;
        $list = [];
        foreach($courses as $course) {
            $list[$course->name] = [];
            if($this->user()->hasRole($course->instructor_role_id)) {
                //Instructor
                $quests = $course->quests()->where('groups', '=', false)->get();
                $group_quests = $course->quests()->where('groups', '=', true)->get();

                foreach($quests as $quest) {
                        //quest name, quest type, student name, revision number, date submitted
                    $users = $quest->users()->where('graded', false)->get();

                    foreach($users as $user) {
                        switch($quest->quest_type_id) {
                            case '1':
                            case '5':
                            case '6':
                                $attempt = Submission::where('user_id', '=', $user->id)
                                                    ->where('quest_id', '=', $quest->id)
                                                    ->where('revision', '=', $user->pivot->revision)
                                                    ->first();
                                break;
                            case '4':
                            case '7':
                                $attempt = Link::where('user_id', '=', $user->id)
                                                    ->where('quest_id', '=', $quest->id)
                                                    ->where('revision', '=', $user->pivot->revision)
                                                    ->first();
                                break;
                        }


                       $list[$course->name][] =  ["quest" => $quest->name,
                                    "quest_id" => $quest->id,
                                    "type" => $quest->quest_type_id,
                                    "student" => $user->name,
                                    "attempt" => $attempt];
                    }

                }

                foreach($group_quests as $quest) {
                    $groups = GroupQuest::where('quest_id', '=', $quest->id)
                                            ->where('graded', '=', false)
                                            ->get();
                    foreach($groups as $group) {
                        switch($quest->quest_type_id) {
                            case '1':
                            case '5':
                            case '6':
                                $attempt = Submission::find($group->attempt_id);
                                break;
                            case '4':
                            case '7':
                                $attempt = Link::find($group->attempt_id);
                            break;
                        }

                       $list[$course->name][] =  ["quest" => $quest->name,
                                    "quest_id" => $quest->id,
                                    "type" => $quest->quest_type_id,
                                    "student" => $group->users->implode('name', ','),
                                    "attempt" => $attempt];
                    }
                }
            }
        }

        return $list;
    }



    public function agenda() {
        $user = $this->user();
        $quests_attempted = $user->quests();
        $quests_attempted_ids = $quests_attempted->pluck('quest_id');
        $group_quests_attempted = $user->group_quests()->with('quest')->get();
        $group_quests_attempted_ids = $group_quests_attempted->pluck('quest_id');
        $enrolled_courses = $this->user()->courses->pluck('id');

        $group_quests = Quest::whereIn('course_id', $enrolled_courses)
                            ->where('groups', '=', true)
                            ->whereNotIn('id', $group_quests_attempted_ids)
                            ->get();

        $timezone = "America/New_York";

        $quests_unattempted_expiring = Quest::whereIn('course_id', $enrolled_courses)
                    ->whereNotIn('id', $quests_attempted_ids)
                    ->where('expires_at', '>', Carbon::now(new \DateTimeZone($timezone))->subDay())
                    ->where('groups', '=', false)
                    ->orderBy('expires_at')
                    ->get();

        $quests_unattempted_not_expiring = Quest::whereIn('course_id', $enrolled_courses)
                    ->whereNotIn('id', $quests_attempted_ids)
                    ->where('groups', '=', false)
                    ->whereNull('expires_at')
                    ->orderBy('name')
                    ->get();

        $quests_unattempted = $quests_unattempted_expiring->merge($quests_unattempted_not_expiring);

        $quests_unattempted = $quests_unattempted->merge($group_quests);
//        return $enrolled_courses;
        return $quests_unattempted->groupBy('expires_at');

    }











    /**
     * Return if the current session user is a guest or not
     * @return mixed
     */
    public function guest()
    {
        return auth()->guest();
    }

	/**
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * Get the currently authenticated user's id
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }

	/**
     * @param $id
     * @return mixed
     */
    public function loginUsingId($id) {
        return auth()->loginUsingId($id);
    }

    /**
     * Checks if the current user has a Role by its name or id
     *
     * @param  string $role Role name.
     * @return bool
     */
    public function hasRole($role)
    {
        if ($user = $this->user()) {
            return $user->hasRole($role);
        }

        return false;
    }

    /**
     * Checks if the user has either one or more, or all of an array of roles
     * @param  $roles
     * @param  bool     $needsAll
     * @return bool
     */
    public function hasRoles($roles, $needsAll = false)
    {
        if ($user = $this->user()) {
            //If not an array, make a one item array
            if (!is_array($roles)) {
                $roles = array($roles);
            }

            return $user->hasRoles($roles, $needsAll);
        }

        return false;
    }

    /**
     * Check if the current user has a permission by its name or id
     *
     * @param  string $permission Permission name or id.
     * @return bool
     */
    public function allow($permission)
    {
        if ($user = $this->user()) {
            return $user->allow($permission);
        }

        return false;
    }

    /**
     * Check an array of permissions and whether or not all are required to continue
     * @param  $permissions
     * @param  $needsAll
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        if ($user = $this->user()) {
            //If not an array, make a one item array
            if (!is_array($permissions)) {
                $permissions = array($permissions);
            }

            return $user->allowMultiple($permissions, $needsAll);
        }

        return false;
    }

    /**
     * @param  $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->allow($permission);
    }

    /**
     * @param  $permissions
     * @param  $needsAll
     * @return bool
     */
    public function hasPermissions($permissions, $needsAll = false)
    {
        return $this->allowMultiple($permissions, $needsAll);
    }
}