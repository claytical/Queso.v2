<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Feedback;
use App\Notice;
use Illuminate\Http\Request;


//use Vinelab\Http\Client as HttpClient;

/**
 * Class FeedbackController
 * @package App\Http\Controllers\Frontend
 */
class FeedbackController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function like($id) {
        $feedback = Feedback::find($id);
        $feedback->likes = $feedback->likes + 1;
        $feedback->save();
        return response()->json(['likes' => $feedback->likes]);
    }

}
