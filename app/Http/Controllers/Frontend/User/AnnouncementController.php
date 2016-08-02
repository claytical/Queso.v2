<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;
use App\Announcement;
use Illuminate\Http\Request;

/**
 * Class AnnouncementController
 * @package App\Http\Controllers\Frontend
 */
class AnnouncementController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index() {
        $announcements = Announcement::where('course_id', '=', session('current_course'))->get();
//        $announcements = Announcement::all();
        return view('frontend.announcements', ['announcements' => $announcements])
            ->withUser(access()->user());
    }

    public function create()
    {
        return view('frontend.manage.announcements.create')
            ->withUser(access()->user());
    }

    public function details($id) {
        $announcement = Announcement::find($id);

        return view('frontend.manage.announcements.details', ['announcement' => $announcement])
            ->withUser(access()->user());

    }

    public function update(Request $request)
    {
        $announcement = Announcement::find($request->announcement_id);
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->course_id = session('current_course');
        $announcement->save();

        return view('frontend.manage.announcements.updated', ['announcement' => $announcement])
            ->withUser(access()->user());
    }

    public function save(Request $request) {
        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->course_id = session('current_course');
        $announcement->sticky = false;
        $announcement->save();
        return view('frontend.manage.announcements.created', ['announcement' => $announcement])
            ->withUser(access()->user());
    }

    public function delete(Request $request) {
        $announcement = Announcement::find($request->announcement_id);
        $title = $announcement->title;
        $announcement->delete();        
        return view('frontend.manage.announcements.deleted', ["title" => $title]);
    }

    public function manage()
    {
        $announcements = Announcement::where('course_id', '=', session('current_course'))->get();
     //   $announcements = Announcement::all();
        return view('frontend.manage.announcements.index', ['announcements' => $announcements])
            ->withUser(access()->user());
    }    
}
