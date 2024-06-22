<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    // To Show all Listings 
    public function index(){
        return view('listings.index',[
            // 'listings' =>Listing::all()
            'listings'=>Listing::latest()->filter(request(['tag', 'search']))->get()
            
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
}
