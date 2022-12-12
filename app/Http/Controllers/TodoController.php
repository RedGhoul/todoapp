<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Str;

class TodoController extends Controller
{
    public function index(){
        return view('todo.index', [
            'heading' => 'Latest todo',
            'todos' => Todo::latest()
                ->filter(request(['keyword']))
                ->where('user_id', '=', auth()->id())->paginate(12)
        ]);
    }

    public function show($todo_id){
        $todo = Todo::where('id', '=',$todo_id)->where('user_id', '=',auth()->id())->first();
        if($todo){
            return view('todo.edit', [
                'todo' => $todo
            ]);
        }
        return redirect('/todo/all')
            ->with('message', 'Could not find todo with id ' . $todo_id);
    }

    // show create form
    public function create(Todo $todo){
        return view('todo.create');
    }

    // store
    public function store(){

        $formFields = request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $formFields['user_id'] = auth()->id();

        Todo::create($formFields);

        return redirect('/todo/all')
            // how to add a flash message
            ->with('message', 'Todo created successfully!');
    }

    //show edit form
    public function edit($todo_id)
    {
        $todo = auth()->user()->todos()->where('id', '=',$todo_id)->first();

        if( $todo){
            return view('todo.edit',['todo' => $todo]);

        }
        return redirect('/')
            // how to add a flash message
            ->with('message', 'Todo was not found !');
    }

    // update
    public function update($todo_id){
        $todo = auth()->user()->todos()->where('id', '=',$todo_id)->first();

        if($todo){
            $formFields = request()->validate([
                'title' => 'required',
                'content' => 'required',
            ]);

            $todo->update($formFields);
            return redirect('/todo/all')
                ->with('message', 'Todo updated successfully!');
        }

        return redirect('/')
            // how to add a flash message
            ->with('message', 'Todo was not found !');
    }

    //delete
    public function destroy($todo_id){
        $todo = auth()->user()->todos()->where('id','=',$todo_id)->first();
        ddd($todo);
        if($todo){
            $todo->delete();
            return redirect('/')->with('message', 'Todo deleted successfully!');
        }
        return redirect('/')
            // how to add a flash message
            ->with('message', 'Todo was not found !');
    }
}
