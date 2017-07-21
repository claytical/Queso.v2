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
use DB;

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

    public function index($course_id) {
        $course = Course::find($course_id);
        $students = $course->users()
                            ->where('id', '!=', access()->user()->id)
                            ->with('skills', 'teams')
                            ->where('course_id', $course->id)
                            ->get();

        return view('frontend.manage.students', ['students' => $students, 'course_id' => $course_id])
            ->withUser(access()->user());
    }    

    public function assign_team($student_id, $team_id) {
        $student = User::find($student_id);
        $student->teams()->where('course_id', session('current_course'))->detach();
        $student->teams()->attach($team_id, ['course_id' => session('current_course')]);
        $team = Team::find($team_id);
        return redirect()->route('student.detail',  ['student_id' => $student_id])->withFlashSuccess($student->name . " has been successfully assigned to " . $team->name);

    }

    public function remove_team($student_id) {
        $student = User::find($student_id);
        $student->teams()->where('course_id', session('current_course'))->detach();
        return redirect()->route('student.detail',  ['student_id' => $student_id])->withFlashSuccess($student->name . " has been removed from their team");
    }

    public function detail($user_id, $course_id) {
        //team, pending
        $user = User::find($user_id);

        $course = Course::find($course_id);
        $teams = $course->teams()->get();

        $team_assignment = $user->teams()->where('team_user.course_id', session('current_course'));
        if($team_assignment->count() == 0) {
            $team = new \stdClass;
            $team->name = "No Team Assigned";
        }
        else {
            $team = $team_assignment->first();
        }

        $course_skills = $course->skills()->get();
        $acquired_skills = [];

        foreach($course_skills as $skill) {
            $amount = $user->skills()->where('skill_id', $skill->id)->sum('amount');
            if(!$amount) {
                $amount = 0;
            }
            $acquired_skills[] = ["amount" => $amount,
                                    "name" => $skill->name];
        }

        $total_points_earned = $user->skills()->where('course_id', '=', $course_id)->sum('amount');
        $total_points_potential = 0;
        if(!$total_points_earned) {
            $total_points_earned = 0;
        }
        $current_level = $course->levels()->where('amount', '<=', $total_points_earned)->orderBy('amount', 'desc')->first();
        $next_level = $course->levels()->where('amount', '>', $total_points_earned)->orderBy('amount', 'desc')->first();
        if(!$next_level) {
            $next_level = $current_level;            
        }
        $percentage = ($total_points_earned / ($current_level->amount + $next_level->amount)) * 100;

        $quest_ids = $user->quests()
                            ->where('course_id', '=', session('current_course'))
                            ->distinct()
                            ->select('quest_id')
                            ->orderBy('quest_user.created_at', 'asc')
                            ->pluck('quest_id');
        $group_quest_ids = $user->group_quests()->pluck('quest_id');

        $all_quest_ids = $course->quests()
                            ->where('course_id', '=', session('current_course'))
                            ->whereIn('id', $group_quest_ids)
                            ->orWhereIn('id', $quest_ids)
                            ->distinct()
                            ->select('id')
                            ->pluck('id');


        $quests_graded = [];
        $quests_ungraded = [];
        $skill_dates = [];
        $skill_amounts = [];
        foreach($all_quest_ids as $id) {
            $q = Quest::find($id);
            if($q->groups) {
                $quest = DB::table('group_quest_users')
                                ->join('group_quest', 'group_quest_users.group_quest_id', '=', 'group_quest.id')
                                ->join('quests', 'group_quest.quest_id', '=', 'quests.id')
                                ->select('quests.name', 'quests.created_at', 'quests.instructions', 'quests.id')
                                ->where('user_id', '=', $user->id)
                                ->where('quest_id', '=', $id)
                                ->orderBy('group_quest.created_at');
                $history = $user->group_quests()->where('quest_id', $id)->first();
            }
            else {
                $quest = $user->quests()->where('quest_id', $id)->orderBy('quest_user.created_at');
                $history = $user->quests()->where('quest_id', $id)->first();

            }
            $revisions = $quest->count() - 1;
            $skills = $user->skills()->where('quest_id', $id)->orderBy('created_at', 'asc')->get();
            $earned = $user->skills()->where('quest_id', $id)->sum('amount');
            $earned_skills = $user->skills()->where('quest_id', $id)->count();

            $available = Quest::find($id)->skills()->sum('amount');
            $quest = $quest->first();
            if($earned_skills > 0) {
                $total_points_potential += $available;
                $quests_graded[] = ['quest_master' => $q, 'quest' => $quest, 'history' => $history, 'revisions' => $revisions, 'skills' => $skills,'earned' => $earned, 'available' => $available];

                foreach($course_skills as $skill) {
                    $amount = $user->skills()->where('skill_id', $skill->id)->where('quest_id', '=', $quest->id)->sum('amount');
                    if(!$amount) {
                        $amount = 0;
                    }
                }
                
            }
            else {
                $quests_ungraded[] = ['quest' => $quest, 'revisions' => $revisions, 'skills' => $skills, 'available' => $available];
            }
        }

   //     javascript()->put(['skillDates' => $skill_dates, 'skillAmounts' => $skill_amounts]);

        $user_skill_levels = array();
        foreach($course_skills as $skill) {
            $user_skill_levels[$skill->id] = $user->skills()->where('skill_id', $skill->id)->sum('amount');
        }

        $quests_unattempted = Quest::where('course_id', '=', $course_id)
                    ->whereNotIn('id', array_merge($quest_ids->toArray(), $group_quest_ids->toArray()))
                    ->orderBy('expires_at')
                    ->get();
        $quests_revisable = Quest::where('course_id', '=', $course_id)
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

        return view('frontend.manage.student', ['student' => $user, 
                                                'total_points' => $total_points_earned, 
                                                'current_level' => $current_level, 
                                                'next_level' => $next_level, 
                                                'graded_quests' => $quests_graded, 
                                                'pending_quests' => $quests_ungraded, 
                                                'available_quests' => $quests_unlocked, 
                                                'locked_quests' => $quests_locked, 
                                                'team' => $team, 
                                                'teams' => $teams, 
                                                'acquired_skills' => $acquired_skills, 
                                                'percentage' => $percentage, 
                                                'total_points_potential' => $total_points_potential,
                                                'course_id' => $course_id])
                                                ->withUser(access()->user());
        }





}
