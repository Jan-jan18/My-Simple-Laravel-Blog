@extends('layouts.app')

@section('content')

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
<div class="container px-4 px-lg-5 mt-5" style="background-color: #ffffff; color: #000000; margin-top: 200px !important;">
    <h1 class="text-center">Create New Blog Post</h1>

    <!-- Display validation errors (if any) -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create a form for creating a new post -->
    <form method="POST" action="{{ route('blog_store') }}">
        @csrf <!-- Include a CSRF token for security -->

        <!-- Title input field -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <!-- Content input field -->
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
        </div>

        <!-- Submit button -->
        <!-- Submit button with custom styling -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Post</button>
        </div>

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



    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS -->
    <script src="{{ url('/') }}/js/scripts.js"></script>
</body>
</html>
