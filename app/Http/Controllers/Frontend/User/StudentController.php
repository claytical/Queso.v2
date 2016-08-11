<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Vinelab\Http\Client as HttpClient;

/**
 * Class GradeController
 * @package App\Http\Controllers\Frontend
 */
class StudentController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $course = Course::find(session('current_course'));
        $students = $course->users()->get();

        return view('frontend.manage.students', ['students' => $students])
            ->withUser(access()->user());
    }    
    public function detail($id) {
        return view('frontend.manage.student')
            ->withUser(access()->user());
    }
}
