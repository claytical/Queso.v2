<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;

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
        return view('frontend.resources.view')
            ->withUser(access()->user());
    }

    public function by_category($category)
    {
        return view('frontend.resources.category')
            ->withUser(access()->user());
    }

    public function create()
    
    {
        return view('frontend.manage.resources.create')
            ->withUser(access()->user());
    }

    public function manage() {
        return view('frontend.manage.resources.index')
            ->withUser(access()->user());

    }

    public function details() {
        return view('frontend.manage.resources.details')
            ->withUser(access()->user());

    }
    
    public function save() {
        return view('frontend.manage.resources.created')
            ->withUser(access()->user());

    }

    public function update() {
        return view('frontend.manage.resources.update')
            ->withUser(access()->user());

    }    

    public function delete() {
        return view('frontend.manage.resources.deleted')
            ->withUser(access()->user());

    }

}
