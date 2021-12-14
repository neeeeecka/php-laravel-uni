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
        $validatedData = $request->validate([
            "is_done" => "required",
        ]); 

        Todo::find($id)->update($validatedData);
        $todo = Todo::find($id);
        return $todo;

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

    /**
     * Soft delete all is_done todos.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request){
        $validatedData = $request->validate([
            "really" => "required",
        ]); 
        Todo::where("is_done", true)->delete();
        return Todo::withTrashed()->where("is_done", true)->get();
    }
}