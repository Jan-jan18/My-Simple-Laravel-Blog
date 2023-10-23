@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Your Profile</h1>
        <form action="{{ route('user_profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Form fields for updating profile information -->
            <!-- Include input fields for display name, profile picture, bio, and social media links -->

            <button type="submit">Update Profile</button>
        </form>
    </div>
@endsection