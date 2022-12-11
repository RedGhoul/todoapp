<?php

namespace App\Http\Controllers;

use App\Models\Todo;

class TodoController extends Controller
{
    public function index(){
        return view('todo.index', [
            'heading' => 'Latest todo',
            'todos' => Todo::latest()
                ->filter(request(['tag','search']))->where('user_id', '=', auth()->id())->paginate(12)
        ]);
    }

    public function show(Todo $todo){
        return view('todo.show', [
            'todo' =>  $todo
        ]);
    }

    // show create form
    public function create(Todo $todo){
        return view('todo.create');
    }

    // store
    public function store(){
        $formFields['user_id'] = auth()->id();
        $formFields = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'user_id',
        ]);

        Todo::create($formFields);

        return redirect('/')
            // how to add a flash message
            ->with('message', 'Todo created successfully!');
    }

    //show edit form
    public function edit(Todo $todo){
        if($todo->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        return view('todo.edit',['todo' => $todo]);
    }

    // update
    public function update(Todo $todo){
        if($todo->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $formFields = request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $todo->update($formFields);

        return back()
            // how to add a flash message
            ->with('message', 'Todo updated successfully!');
    }

    //delete
    public function destroy(Todo $todo){
        if($todo->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $todo->delete();
        return redirect('/')->with('message', 'Todo deleted successfully!');
    }
}
