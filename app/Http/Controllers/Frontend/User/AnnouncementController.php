<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;

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
        return view('frontend.announcements')
            ->withUser(access()->user());
    }

    public function create()
    {
        return view('frontend.manage.create_announcement')
            ->withUser(access()->user());
    }

    public function details($id) {
        return view('frontend.manage.announcement_details')
            ->withUser(access()->user());

    }

    public function update()
    {
        return view('frontend.manage.updated_announcement')
            ->withUser(access()->user());
    }

    public function save() {
        return view('frontend.manage.created_announcement')
            ->withUser(access()->user());
    }


    public function manage()
    {
        return view('frontend.manage.announcements')
            ->withUser(access()->user());
    }    
}
