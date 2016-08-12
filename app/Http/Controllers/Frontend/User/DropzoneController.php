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

public function getJSON() {
    $array = ["error" => "success", "stuff" => [1,2,3]];
    return response()->json($array);
}

public function uploadFiles(Request $request) {
 
        $files = $request->file('file');
        $files_on_server = array();
        $no_of_files = count($files);
        if($no_of_files==0) {
            return response()->json(array("error" => "No Files"));
        }
        else if ($no_of_files == 1) {
            $random_name = str_random(5).$files->getClientOriginalName();
            $files->move(public_path().'/uploads/',$random_name);
            $files_on_server[] = $random_name;
            return response()->json(array("error" => "Success!", "file" => $random_name));

        }
        else {
            for($i=0;$i<$no_of_files;$i++) {
                $file = $files[$i];
                if($file){
                    $random_name=str_random(5).$file->getClientOriginalName();
                    $file->move(public_path().'/uploads/',$random_name);
                    $files_on_server[] = $random_name;
                    //TODO: Store in database with user id

                }
            }
            return response()->json(array("error" => "Success!", "files" => $files_on_server));
        }

    }

}
