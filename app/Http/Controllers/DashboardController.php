<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userProfile = UserProfile::where('user_id', auth()->user()->id)->first();
        return view('dashboard.index', compact('userProfile'));
    }

    public function dashboard()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Retrieve the user's profile
        $userProfile = UserProfile::where('user_id', $user->id)->first();

        // You can add more logic here to fetch other dashboard-related data if needed

        // Pass the user and user profile data to the view
        return view('dashboard.index', compact('user', 'userProfile'));
    }

    // Display the user's profile information
    public function viewProfile()
    {
    // Get the currently authenticated user
    $user = auth()->user();

    // Retrieve the user's profile
    $userProfile = UserProfile::where('user_id', $user->id)->first();

    if ($userProfile) {
        // User profile exists
        return view('dashboard.index', compact('userProfile'));
    } else {
        // User profile doesn't exist
        return view('dashboard.index')->with('message', 'User profile not found. Please create your profile.');
    }
    }

    public function edit()
    {
        // Retrieve the currently authenticated user
        $user = auth()->user();

        // Retrieve the user's profile (assuming you have a relationship set up)
        $userProfile = $user->userProfile;

        // If the user doesn't have a profile, you can handle it here, create one, or show an error

        return view('dashboard.edit', compact('user', 'userProfile'));
    }

}
