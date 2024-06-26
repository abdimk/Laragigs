<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Listing;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ListingController extends Controller
{
    // To Show all Listings 
    public function index(){
        return view('listings.index',[
            // 'listings' =>Listing::all()
            'listings'=>Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
            
        ]);
    }

    // To Show individual Listings
    public function show(Listing $listing){
        if($listing){
            return view('listings.show',['listing'=> $listing]);
        }else{
            abort(404);
        }
    }

    //Show create form
    public function create(){
        return view('listings.create');
    }


    // Store listing form
    public function store(Request $request){
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
       
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message','Listing created sucessfully!');
    }


    public function edit(Listing $listing){
        return view('listings.edit', ['listing'=> $listing]);
    }


    // Update the listing form
    public function update(Request $request, Listing $listing){

        //Make sure the logedd user is the owner 
        if($listing->user_id != auth()->id()){
            abort(403,'Unautorized action');
        }
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        $listing->update($formFields);

        return back()->with('message','Listing updated sucessfully!');
    }


    public function destroy(Listing $listing){
        //Make sure the logedd user is the owner 
        if($listing->user_id != auth()->id()){
            abort(403,'Unautorized action');
        }

        $listing->delete();
        return redirect('/')->with('message','List has been deleted sucessfully');

    }


    // Manage Listings 
    public function manage(){
        return view('listings.manage', ['listings'=>auth()->user()->listings()->get()]);
    }


    
}
