<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Quest;
use App\Skill;
use App\Threshold;
use App\Link;
use App\Level;
use App\Models\Access\User\User;
use App\Team;


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
        $students = $course->users()->with('skills', 'teams')->where('course_id', $course->id)->get();

        return view('frontend.manage.students', ['students' => $students])
            ->withUser(access()->user());
    }    
    public function detail($id) {
        //team, pending
        $user = User::find($id);

        $course = Course::find(session('current_course'));
        $teams = $course->teams()->get();

        $team = $user->teams()->where('user_team.course_id', session('current_course'))->first();

        $course_skills = $course->skills()->get();
        $acquired_skills = [];

        foreach($course_skills as $skill) {
            $acquired_skills[] = ["amount" => $user->skills()->where('skill_id', $skill->id)->sum('amount'),
                                    "name" => $skill->name];
        }

        $total_points_earned = $user->skills()->sum('amount');
        $current_level = $course->levels()->where('amount', '<=', $total_points_earned)->orderBy('amount', 'desc')->first();
        $next_level = $course->levels()->where('amount', '>', $total_points_earned)->orderBy('amount', 'desc')->first();

        $percentage = ($total_points_earned / ($current_level->amount + $next_level->amount)) * 100;

        $quest_ids = $user->quests()->distinct()->select('quest_id')->orderBy('quest_user.created_at', 'asc')->pluck('quest_id');
        $quests_graded = [];
        $quests_ungraded = [];
        foreach($quest_ids as $id) {
            $quest = $user->quests()->where('quest_id', $id)->orderBy('quest_user.created_at');
            $revisions = $quest->count();
            $skills = $user->skills()->where('quest_id', $id)->get();
            $earned = $user->skills()->where('quest_id', $id)->sum('amount');
            $available = Quest::find($id)->skills()->sum('amount');
            $quest = $quest->first();
            if($quest->graded) {
                $quests_graded[] = ['quest' => $quest, 'revisions' => $revisions, 'skills' => $skills,'earned' => $earned, 'available' => $available];

            }
            else {
                $quests_ungraded[] = ['quest' => $quest, 'revisions' => $revisions, 'skills' => $skills, 'available' => $available];
            }
        }


        $user_skill_levels = array();
        foreach($course_skills as $skill) {
            $user_skill_levels[$skill->id] = $user->skills()->where('skill_id', $skill->id)->sum('amount');
        }

        $quests_unattempted = Quest::where('course_id', '=', session('current_course'))
                    ->whereNotIn('id', $quest_ids)
                    ->orderBy('expires_at')
                    ->get();
        $quests_revisable = Quest::where('course_id', '=', session('current_course'))
                    ->whereIn('id', $quest_ids)
                    ->where('revisions', '=', true)
                    ->orderBy('expires_at')
                    ->get();

        $quests_locked = array();
        $quests_unlocked = array();

        foreach($quests_unattempted as $quest) {
            $thresholds = $quest->thresholds()->get();
            $met = true;
            foreach($thresholds as $threshold) {
                if($threshold->amount > $user_skill_levels[$threshold->skill_id]) {
                    $met = false;
                }
            }
            if($met) {
                $quests_unlocked[] = $quest;
            }
            else {
                $quests_locked[] = $quest;
            }
        }

        return view('frontend.manage.student', ['student' => $user, 'total_points' => $total_points_earned, 'current_level' => $current_level, 'graded_quests' => $quests_graded, 'pending_quests' => $quests_ungraded, 'available_quests' => $quests_unlocked, 'locked_quests' => $quests_locked, 'team' => $team, 'teams' => $teams])
            ->withUser(access()->user());
    }

    public function assign_team($student_id, $team_id) {
        $student = User::find($student_id);
        $student->teams()->attach($team_id, ['course_id' => session('current_course')]);
        $team = Team::find($team_id);
        return redirect()->route('student.detail',  ['student_id' => $student_id])->withFlashSuccess($student->name . " has been successfully assigned to " . $team->name);

    }

    public function remove_team($student_id) {
        $student = User::find($student_id);
        $student->teams()->where('course_id', session('current_course'))->detach();
        return redirect()->route('student.detail',  ['student_id' => $student_id])->withFlashSuccess($student->name . " has been removed from their team");

    }
}
