<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Vinelab\Http\Client as HttpClient;
use App\Content;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class ResourceController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function by_id($id) {
        $resource = Content::find($id);
        return view('frontend.resources.view', ['resource' => $resource])
            ->withUser(access()->user());
    }

    public function by_category($category) {
        $category = str_replace(" ", "-", $category);
        $resources = Content::where('course_id', '=', session('current_course'))
                            ->where('tag', '=', $category)
                            ->get();
        return view('frontend.resources.category', ['resources' => $resources, 'title' => $category])
            ->withUser(access()->user());
    }

    public function create() {
        return view('frontend.manage.resources.create')
            ->withUser(access()->user());
    }

    public function manage() {
        return view('frontend.manage.resources.index')
            ->withUser(access()->user());

    }

    public function details($id) {
        $resource = Content::find($id);
        return view('frontend.manage.resources.details', ['resource' => $resource])
            ->withUser(access()->user());

    }
    
    public function save(Request $request) {
        $resource = new Content;
        $resource->course_id = session('current_course');
        $resource->title = $request->title;
        $resource->description = $request->description;
        $html = "";
        /*
        if(strlen($request->link) > 0) {
            $resource->link = $request->link;
            $client = new HttpClient;
            $response = $client->get("http://iframe.ly/api/oembed?url=" . urlencode($request->link) . "&api_key=a705fe8012d914a446d7e4");
            $embedly = json_decode($response->json());
            if (!empty($embedly->html)) {
                $html = $embedly->html;
            }
        }
        */
        if(strlen($request->tag) > 0) {
            $resource->tag = $request->tag;
        }
        
        $resource->save();
    //    $resource = new Content;
  //      $resource->course_id = session('current_course');
 //       $resource->title = $request->title;
//        $resource->description = $request->description;
//        $html = "";
 /*
        if(strlen($request->link > 0)) {
            $resource->link = $request->link;
            $client = new HttpClient;
            $response = $client->get("http://iframe.ly/api/oembed?url=" . urlencode($request->link) . "&api_key=a705fe8012d914a446d7e4");
            $embedly = json_decode($response->json());
            if (!empty($embedly->html)) {
                $html = $embedly->html;
            }

        }
        if(strlen($request->tag > 0)) {
            $resource->tag = $request->tag;
        }


*/

        return view('frontend.manage.resources.created')
            ->withUser(access()->user());

    }

    public function update(Request $request) {
        $resource = Content::find($request->id);
        $resource->title = $request->title;
        $resource->description = $request->description;
        $resource->link = $request->link;
        $resource->save();
        return view('frontend.manage.resources.update')
            ->withUser(access()->user());

    }    

    public function delete() {
        return view('frontend.manage.resources.deleted')
            ->withUser(access()->user());

    }

}
