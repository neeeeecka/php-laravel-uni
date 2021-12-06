<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
 
class BlogController extends Controller
{
  
    /**
     * Show blog page
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function showBlog(Request $request){
        $posts = Blog::paginate(7);
     

        return view("pages.blog", [
            "posts" => $posts
        ]);
    }
    
    /**
     * Show full page blog post
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function showPost(Request $request){
        // $data["slug"] = $request->slug;
        // $data["title"] = str_replace("-", " ", $request->slug);
        
        // return view("pages.post", $data);

        $post = Blog::where("slug", $request->slug)->get();
        return view("pages.post", $post[0]);
    }

    public function index(Request $request){
        $result = Blog::paginate(7);
        return $result;
    }

    public function recommended(Request $request){
        $result = Blog::get()->take(3);
        return $result;
    }
}