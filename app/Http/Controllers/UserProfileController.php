<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $userProfile = UserProfile::where('user_id', auth()->user()->id)->first();
        return view('user_dashboard.index', compact('userProfile'));
    }

    public function update(Request $request)
    {
        $userProfile = UserProfile::where('user_id', auth()->user()->id)->first();

        // Validate and update user profile information
        $request->validate([
            'display_name' => 'required|max:255',
            'bio' => 'max:255',
            'website' => 'nullable|url',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $userProfile->display_name = $request->input('display_name');
        $userProfile->bio = $request->input('bio');
        $userProfile->website = $request->input('website');

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->move(public_path('profile_pictures'), $filename);
            $userProfile->profile_picture = $filename;
        }

        $userProfile->save();

        return redirect()->route('user_dashboard')->with('success', 'Profile updated successfully');
    }

    // Display the user dashboard
    public function dashboard()
    {
        return view('user.dashboard');
    }

    // Display the user's profile information
    public function viewProfile()
    {
        return view('user_dashboard.index');
    }

    // Handle profile picture upload
    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rules for image files
        ]);

        // Check if the request has a file
        if ($request->hasFile('profile_picture')) {
            // Get the uploaded file
            $file = $request->file('profile_picture');

            // Store the file in the storage/app/public directory (you may need to configure storage links)
            $path = $file->store('public/profile_pictures');

            // Save the file path to the user's profile
            auth()->user()->profile->profile_picture = $path;
            auth()->user()->profile->save();

            return redirect()->route('user_profile')->with('success', 'Profile picture uploaded successfully.');
        }

        return redirect()->route('user_profile')->with('error', 'Profile picture upload failed.');
    }
}
