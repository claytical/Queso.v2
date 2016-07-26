<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function splash()
    {

        return view('frontend.splash');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
}
