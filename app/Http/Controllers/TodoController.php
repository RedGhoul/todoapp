<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    public function index(){
        return view('listings.index', [
            'heading' => 'Latest Listings',
            'listings' => Listing::latest()
                ->filter(request(['tag','search']))->paginate(12)
        ]);
    }

    public function show(Listing $listing){
        return view('listings.show', [
            'listing' =>  $listing
        ]);
    }

    // show create form
    public function create(Listing $listing){
        return view('listings.create');
    }

    // store
    public function store(){

        $formFields = request()->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required',
        ]);


        if(request()->hasFile('logo')){
            $formFields['logo'] = request()->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')
            // how to add a flash message
            ->with('message', 'Listing created successfully!');
    }

    //show edit form
    public function edit(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        return view('listings.edit',['listing' => $listing]);
    }

    // update
    public function update(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $formFields = request()->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required',
        ]);


        if(request()->hasFile('logo')){
            $formFields['logo'] = request()->file('logo')->store('logos','public');
        }

        $listing->update($formFields);

        return back()
            // how to add a flash message
            ->with('message', 'Listing updated successfully!');
    }

    //delete
    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }
}
