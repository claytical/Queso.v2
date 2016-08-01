<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Services\Access\Traits\ConfirmUsers;
use App\Services\Access\Traits\UseSocialite;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Services\Access\Traits\AuthenticatesAndRegistersUsers;
use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use App\Course;
/**
 * Class AuthController
 * @package App\Http\Controllers\Frontend\Auth
 */
class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ConfirmUsers, ThrottlesLogins, UseSocialite;

    /**
     * @param UserRepositoryContract $user
     */
    public function __construct(UserRepositoryContract $user)
    {
        //Where to redirect after logging out
        $this->redirectAfterLogout = route('frontend.index');

        $this->user = $user;
    }

    /**
     * Where to redirect users after login / registration.
     * @return string
     */
    public function redirectPath()
    {

        //Check if user has a default course
        //if they do, go to dashboard, if not
        //page to add class or join course
        //return route('frontend.user.choose');

        $user = access()->user();
        if($user->default_course_id == 0) {
            return route('frontend.user.choose');
        }
        else {
            session(['current_course' => $user->default_course_id]);

            //CHECK IF INSTRUCTOR OF DEFAULT COURSE
//            $course = Course::find($user->default_course_id);
            if(access()->hasPermission(access()->hasPermission('course-' . $user->default_course_id . '-instructor'))) {
                //IS INSTRUCTOR
                    session(['perm' => 'is instructor']);


                $course = Course::find($user->default_course_id);
                if($course->skills()->count == 0) {
                    //no skills, go to skills page
                    return route('course.add.skills');
                }
                else if($course->levels()->count == 0) {
                    //no levels, go to the levels page
                    return route('course.add.levels');
                }

            }
            else {
                session(['perm' => 'not available']);
            }
            //double check access for user?
            return route('frontend.user.dashboard');

        }


        if (access()->allow('view-backend')) {
            return route('admin.dashboard');
        }
        
//        return route('frontend.user.dashboard');

    }
}