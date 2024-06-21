<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('listings',[
        'heading'=>"Latest Listing",
        'listings' =>Listing::all()
        
    ]);
});


// Single Listing Route

Route::get('/listings/{listing}', function(Listing $listing){
    // $listing = Listing::find($id);
    if($listing){
        return view('listing',['listing'=> $listing]);
    }else{
        abort(404);
    }
    
});
