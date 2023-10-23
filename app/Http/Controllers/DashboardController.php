<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;

class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $userProfile = UserProfile::where('user_id', $user->id)->first();
    return view('dashboard.index', compact('user', 'userProfile'));
}
}
