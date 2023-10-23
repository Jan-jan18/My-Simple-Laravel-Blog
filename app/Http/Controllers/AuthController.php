<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

use App\Models\User;
use App\Models\UserProfile;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }
    public function auth_login(Request $request) {
        $remember = !empty($request->remember) ? true : false;

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('home');
        }
        else {
            return redirect()->back()->with('error', "Please enter correct email and password");
        }
    }
    public function auth_logout() {
        Auth::logout();
        return redirect('login');
    }




    public function register() {
        return view('auth.register');
    }

    public function create_user(Request $request) {
        // Validate user registration data
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
    
        // Create a new user record
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->save();
    
        // Create a user profile for the registered user
        $userProfile = new UserProfile;
        $userProfile->user_id = $user->id;
        $userProfile->display_name = $user->name;
        // Include other profile information as needed
        $userProfile->save();
    
        return redirect()->route('login')->with('success', "Registration Success!");
    }

}
