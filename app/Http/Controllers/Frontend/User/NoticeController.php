<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;
use App\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class NoticeController
 * @package App\Http\Controllers\Frontend
 */
class NoticeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */


    public function dismiss($id) {
        $notice = Notice::find($id);
        $notice->received = Carbon::now();
        $notice->save();
        return redirect()->route('frontend.user.dashboard')->withFlashSuccess("Notification has been dismissed.");
    }
 
}
