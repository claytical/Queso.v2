<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FileAttachment;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class DropzoneController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

public function getJSON() {
    $array = ["error" => "success", "stuff" => [1,2,3]];
    return response()->json($array);
}

public function removeFile($id) {
    
    return redirect()->back()->withFlashSuccess("File has been removed.");

}

public function uploadFiles(Request $request) {
        $user = access()->user();
        $files = $request->file('file');
        $files_on_server = array();
        $no_of_files = count($files);
        if($no_of_files==0) {
            return response()->json(array("error" => "No Files"));
        }
        else if ($no_of_files == 1) {
            $attachment = new FileAttachment;
            $random_name = str_random(5).$files->getClientOriginalName();
            $files->move(public_path().'/uploads/',$random_name);
            $attachment->name = $random_name;
            $attachment->course_id = session('current_course');
            $attachment->user_id = $user->id;
            $attachment->save();

            $files_on_server[] = ["name" => $random_name, "id" => $attachment->id];
            //TODO: Store in database with user id

            return response()->json(array("error" => "Success!", "files" => $files_on_server));

        }
        else {
            for($i=0;$i<$no_of_files;$i++) {
                $file = $files[$i];
                if($file){
                    $random_name=str_random(5).$file->getClientOriginalName();
                    $file->move(public_path().'/uploads/',$random_name);
                    //TODO: Store in database with user id
                    $attachment = new FileAttachment;
                    $attachment->name = $random_name;
                    $attachment->course_id = session('current_course');
                    $attachment->user_id = $user->id;
                    $attachment->save();

                    $files_on_server[] = ["name" => $random_name, "id" => $attachment->id];

                }
            }
            return response()->json(array("error" => "Success!", "files" => $files_on_server));
        }

    }

}
