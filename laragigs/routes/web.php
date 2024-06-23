<?php

use App\Http\Controllers\ListingController;
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

// Naming conventions
// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listings
// store - Store new listing
// edit - Show form new listing
// update - Update listing
// destroy - Delete listing

//All listings
Route::get('/',[ListingController::class, 'index']);



//Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

//Store the listing data
Route::post('/listings', [ListingController::class, 'store']);

// Single Listing Route
Route::get('/listings/{listing}', [ListingController::class, 'show']);
    // $listing = Listing::find($id);

