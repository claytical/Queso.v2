<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
 
        $files = $request->file('file');
        $no_of_files = count($files);
        if($no_of_files==0) {
            return "Valueless calling!";
        }
        for($i=0;$i<$no_of_files;$i++) {
            $file = $files[$i];
            if($file){
                $random_name=str_random(30).".".$file->getClientOriginalExtension();
                $file->move(public_path().'/uploads/',$random_name);
                $original_image_name=base_path()."/public/uploads/".$random_name;
                $thumb_image_name=base_path()."/public/uploads/".$random_name;
     
            }
        }
/*        $destinationPath = 'uploads'; // upload path
        $extension = $request->file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = $request->file('file')->move($destinationPath, $fileName); // uploading file to given path
 
        if ($upload_success) {

            return response()->json(['success']);
        } else {
            return response()->json(['error']);
        }
  */
        return "SUCCESS";
    }

}
