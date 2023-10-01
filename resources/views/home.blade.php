@extends('layouts.app')
@section('style')
@endsection
@section('content')
        
        <!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">


            @foreach ($posts as $post)
    <!-- Post preview-->
    <div class="post-preview">
        <a href="{{ route('blog.show', $post) }}">
            <h2 class="post-title">{{ $post->title }}</h2>
            <!-- You can add a post subtitle if you have one -->
            <!-- <h3 class="post-subtitle">Subtitle goes here</h3> -->
        </a>
        <p class="post-meta">
            Posted by
            <a href="#!">{{ $post->user->name }}</a>
            on {{ $post->created_at->format('F j, Y') }}
        </p>
    </div>
    <!-- Divider-->
    <hr class="my-4" />
@endforeach

            
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        </div>
    </div>
</div>

        @endsection
        @section('script')
        @endsection