<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    //Show Register/create form
    public function create(){
        return view('users.register');
    }


    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email',Rule::unique('users','email')],
            'password' => 'required|confirmed|min:4'

        ]);

        //HashPassword 
        $formFields['password'] = bcrypt($formFields['password']);


        //Create User
        $user = User::create($formFields);


        //Login
        auth()->login($user);


        return redirect('/')->with('message', 'User created and logged in');
    }

    //Logout user 
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }


    //Show login form 
    public function login(Request $request){
        return view('users.login');
    }


    //authenticate users

    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();


            return redirect('/')->with('message', 'You have logged in!');
        }

        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }


    


}
