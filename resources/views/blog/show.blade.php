<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Laravel Blog</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{url('/')}}/css/styles.css" rel="stylesheet" />
    </head>

    
    <body>



<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav" style="background-color: #343a40; background-image: url('/assets/img/home-bg.jpg'); background-size: cover;">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}" style="color: #ffffff;">Laravel Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('home') }}" style="color: #ffffff;">Home</a></li>

                @guest
                    <!-- Display "Login" and "Register" links for guests -->
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}" style="color: #ffffff;">Login</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('register') }}" style="color: #ffffff;">Register</a></li>
                @else
                    <!-- Display "Create Post," user's name, and "Logout" link for authenticated users -->
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('create_post')}}" style="color: #ffffff;">Create Post</a></li>
                    <li class="nav-item"><span class="nav-link px-lg-3 py-3 py-lg-4" style="color: #ffffff;">Welcome, {{ auth()->user()->name }}</span></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth_logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link px-lg-3 py-3 py-lg-4" style="color: #ffffff;">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>




        
<!-- Content Container -->
<div class="container px-4 px-lg-5 mt-5 text-center" style="margin-top: 200px !important;">
    <h1>{{ $post->title }}</h1>
    <p class="lead">{{ $post->content }}</p>

    <p class="text-muted">Posted by: 
        @if ($post->user)
            {{ $post->user->name }}
        @else
            Unknown User
        @endif
        on {{ $post->created_at->format('F j, Y') }}
    </p>
</div>
<!-- Comments Section -->
<div class="container px-4 px-lg-5 mt-5">
    <h2>Comments</h2>

    <!-- List of Comments -->
    @if ($post->comments && count($post->comments) > 0)
        <ul class="list-unstyled">
            @foreach ($post->comments as $comment)
                <li class="mb-3">
                    <div class="comment">
                        <div class="comment-header">
                            <strong>{{ $comment->user ? $comment->user->name : 'Unknown User' }}</strong> on {{ $comment->created_at->format('F j, Y') }}
                        </div>
                        <div class="comment-content">
                            {{ $comment->content }}
                        </div>
                    </div>
                    <!-- Nested Replies -->
                    @if ($comment->replies && count($comment->replies) > 0)
                        @foreach ($comment->replies as $reply)
                            <div class="reply ml-4">
                                <div class="reply-header">
                                    <strong>{{ $reply->user ? $reply->user->name : 'Unknown User' }}</strong> on {{ $reply->created_at->format('F j, Y') }}
                                </div>
                                <div class="reply-content">
                                    {{ $reply->content }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>No comments yet.</p>
    @endif
</div>





<!-- Add this code below your post content -->
<div class="container px-4 px-lg-5 mt-5">
    <h3>Add a Comment</h3>
    <form method="POST" action="{{ route('post_comment', ['post' => $post]) }}">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <textarea name="content" class="form-control" rows="4" placeholder="Your comment..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>





        <!-- Footer-->
<footer class="border-top">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#!">
                            <span class="fa-stack fa-lg">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <div class="small text-center text-muted fst-italic">Copyright &copy; Your Website 2023</div>
            </div>
        </div>
    </div>
</footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ url('/')}}/js/scripts.js"></script>
    </body>
</html>





