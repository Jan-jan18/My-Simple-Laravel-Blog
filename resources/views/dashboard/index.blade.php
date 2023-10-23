@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Display the user's profile information -->
                        <p><strong>Display Name:</strong> {{ $userProfile->display_name }}</p>
                        <p><strong>Bio:</strong> {{ $userProfile->bio }}</p>
                        <p><strong>Website:</strong> {{ $userProfile->website }}</p>

                        <!-- Display the user's profile picture (if available) -->
                        @if ($userProfile->profile_picture)
                            <img src="{{ asset('profile_pictures/' . $userProfile->profile_picture) }}" alt="Profile Picture" class="img-thumbnail">
                        @endif

                        <!-- Add an "Edit" button to update the profile -->
                        <a href="{{ route('user_profile_edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
