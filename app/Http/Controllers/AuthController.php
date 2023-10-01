<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Models\User;
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
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $save = new User;
        $save->name = trim($request->name);
        $save->email = trim($request->email);
        $save->password = Hash::make($request->password);
        $save->save();

        return redirect()->route('login')->with('success', "Registration Success!");
    }

}
