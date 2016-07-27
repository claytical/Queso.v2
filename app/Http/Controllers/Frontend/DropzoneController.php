<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Input;
use Validator;
use Request;
use Response;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class DropzoneController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */


public function uploadFiles(Request $request) {
 

        $destinationPath = 'uploads'; // upload path
        $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $request->file('file')->move($destinationPath, $fileName); // uploading file to given path
 
        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }

}
