<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class ResourceController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function by_id($id)
    {
        return view('resources.view')
            ->withUser(access()->user());
    }

    public function by_category($category)
    {
        return view('resources.category')
            ->withUser(access()->user());
    }    
}
