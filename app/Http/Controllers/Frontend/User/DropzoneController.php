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


public function uploadFiles(Request $request) {
 
        $files = $request->file('file');
        $files_on_server = array();
        $no_of_files = count($files);
        if($no_of_files==0) {
            return "ERROR, NO FILES!";
        }
        for($i=0;$i<$no_of_files;$i++) {
            $file = $files[$i];
            if($file){
                $random_name=$file->getClientOriginalName().str_random(5).".".$file->getClientOriginalExtension();
                $file->move(public_path().'/uploads/',$random_name);
                $files_on_server[] = $random_name;
                //TODO: Store in database with user id

            }
        }
        return response()->json($files_on_server);
    }

}
