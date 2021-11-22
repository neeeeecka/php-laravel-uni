<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
  
    /**
     * Show blog page
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function showBlog(Request $request){
        return view("pages.blog");
    }
    
    /**
     * Show full page blog post
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function showPost(Request $request){
        $data["slug"] = $request->slug;
        $data["title"] = str_replace("-", " ", $request->slug);
        
        return view("pages.post", $data);
    }
}