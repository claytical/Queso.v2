<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Request;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class DropzoneController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

public function test() {
    return response()->json("Hi");
}
public function uploadFiles(Request $request) {
 

        $destinationPath = 'uploads'; // upload path
        $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $request->file('file')->move($destinationPath, $fileName); // uploading file to given path
 
        if ($upload_success) {

            return response()->json(['success']);
        } else {
            return response()->json(['error']);
        }
    }

}
