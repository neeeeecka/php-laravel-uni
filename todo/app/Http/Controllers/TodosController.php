<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy("id", "desc")->get();

        return view("pages.main", [
            "todos" => $todos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "text" => "required",
        ]); 

        $all = $request->all();
        $data = [
            "text" => $all["text"]
        ];
        
        $newTodo = Todo::create($data);
        return $newTodo;
        // $slug = [
        //     "slug" => strtolower(str_replace(" ", "-", $request->input("title")))
        // ];
        // Blog::create($request->all() + $slug);
        
        // return redirect()->route("todos.index")->with("success", "Todo has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //     $validatedData = $request->validate([
        //     "title" => "required",
        //     "body" => "required",
        // ]);

        // Blog::where("slug", $slug)->update($validatedData);

        // return redirect("/posts")->with("success", "Post has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}