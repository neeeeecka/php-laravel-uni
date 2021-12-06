<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Blog::latest()->paginate(7);
     
        return view("pages.blog", [
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.create_post");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "body" => "required",
        ]);
        $slug = [
            "slug" => strtolower(str_replace(" ", "-", $request->input("title")))
        ];
        Blog::create($request->all() + $slug);
        
        return redirect()->route("posts.index")->with("success", "Post has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\String  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Blog::where("slug", $slug)->firstOrFail();
        return view("pages.post", $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\String  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Blog::where("slug", $slug)->firstOrFail();
        return view("pages.post_edit", $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\String  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            "title" => "required",
            "body" => "required",
        ]);

        Blog::where("slug", $slug)->update($validatedData);

        return redirect("/posts")->with("success", "Post has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\String  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Blog::where("slug", $slug)->firstOrFail();
        $post->delete();

        return redirect("/posts")->with("success", "Post has been deleted");
    }
}