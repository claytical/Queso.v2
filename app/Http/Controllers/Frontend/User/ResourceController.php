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
        $files = $resource->files;
        return view('frontend.resources.view', ['resource' => $resource, 'files' => $files])
            ->withUser(access()->user());
    }

    public function by_slug($slug) {
        $resource = Content::findBySlug($slug);
        $files = $resource->files;
        return view('frontend.resources.view', ['resource' => $resource, 'files' => $files])
            ->withUser(access()->user());
    }

    public function by_category($category) {
        $category = str_replace(" ", "-", $category);
        $resources = Content::where('course_id', '=', session('current_course'))
                            ->where('tag', '=', $category)
                            ->with('files')
                            ->get();
        return view('frontend.resources.category', ['resources' => $resources, 'title' => $category])
            ->withUser(access()->user());
    }

    public function choose($course_id) {
        return view('frontend.manage.resources.choose', ['course_id' => $course_id])
            ->withUser(access()->user());
    }

    public function create_link($course_id) {
        return view('frontend.manage.resources.create.link', ['course_id' => $course_id])
            ->withUser(access()->user());
    }

    public function create_content($course_id) {
        return view('frontend.manage.resources.create.content', ['course_id' => $course_id])
            ->withUser(access()->user());
    }

    public function manage($course_id) {
        $resources = Content::where('course_id', '=', $course_id)
                    ->get();
        return view('frontend.manage.resources.index', ['resources' => $resources, 'course_id' => $course_id])
            ->withUser(access()->user());

    }

    public function details($id) {
        $resource = Content::find($id);
        $files = $resource->files;
        return view('frontend.manage.resources.details', ['resource' => $resource, 'files' => $files])
            ->withUser(access()->user());

    }
    
    public function save(Request $request) {
        $resource = new Content;
        $resource->course_id = $request->course_id;
        $resource->title = $request->title;
        if(strlen($request->tag) > 0) {
            $resource->tag = $request->tag;
        }

        if($request->resource_type == 1) {
            $resource->description = $request->description;
        }
        if($request->resource_type == 2) {
            $resource->link = $request->link;
            $resource->description = "";
        }
        
        $resource->save();
        if($request->has('files')) {
            $files = $request->input('files');
            for($i = 0; $i < count($files); $i++) {
                $resource->files()->attach($files[$i]);
            }
        }        
        return redirect()->route('resources.manage', $request->course_id)->withFlashSuccess($resource->title . " has been created");
    }

    public function update(Request $request) {
        $resource = Content::find($request->id);
        $resource->title = $request->title;
        $resource->description = $request->description;
        $resource->link = $request->link;
        if(strlen($request->tag) > 0) {
            $resource->tag = $request->tag;
        }
        else {
            $resource->tag = null;
        }
        if($request->has('link_label')) {
            $resource->link_label = $request->link_label;
        }
        else {
            $resource->link_label = null;
        }

        $resource->save();
        if($request->has('files')) {
            $files = $request->input('files');
            for($i = 0; $i < count($files); $i++) {
                $resource->files()->attach($files[$i]);
            }
        }
        return redirect()->route('resources.manage', ['course_id' => $course_id])->withFlashSuccess($resource->title . " has been updated");

    }    

    public function delete($id) {
        $resource = Content::find($id);
        $course_id = $resource->course_id;
        $resource->delete();
        return redirect()->route('resources.manage', ['course_id' => $course_id])->withFlashSuccess($resource->title . " has been removed");

    }

}
