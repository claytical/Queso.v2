<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.welcome')
            ->withUser(access()->user());
    }
    
    public function available_quests()
    {
        return view('frontend.quests.available');
//            ->withUser(access()->user());
    }    
}
