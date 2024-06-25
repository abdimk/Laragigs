<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Contracts\Auth\UserProvider;

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
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//Store the listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//Show edit listings
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->middleware('auth');


//Edit submit to update
Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');


//Delete listing 
Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->middleware('auth');

//Manage Listinga
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing Route
Route::get('/listings/{listing}', [ListingController::class, 'show']);
    // $listing = Listing::find($id);



// Show Register Create Route Form
Route::get('/register',[UserController::class, 'create'])->middleware('guest');

//Create new user 
Route::post('/users',[UserController::class, 'store']);


//Log out user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');




//Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');


//Login user
Route::post('/users/login', [UserController::class, 'authenticate']);


