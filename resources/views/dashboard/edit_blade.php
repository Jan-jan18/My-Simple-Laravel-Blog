@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Profile update form -->
                        <form method="POST" action="{{ route('user_profile_update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input type="text" name="display_name" id="display_name" class="form-control" value="{{ $userProfile->display_name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea name="bio" id="bio" class="form-control" rows="4">{{ $userProfile->bio }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" class="form-control" value="{{ $userProfile->website }}">
                            </div>

                            <div class="form-group">
                                <label for="profile_picture">Profile Picture</label>
                                <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
                            </div>

                            @if ($userProfile->profile_picture)
                                <p>Current Profile Picture:</p>
                                <img src="{{ asset('storage/' . $userProfile->profile_picture) }}" alt="Profile Picture" class="img-thumbnail">
                            @endif

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                                <a href="{{ route('user_dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
