<!-- Page Header-->
<header class="masthead" style="background-image: {{ url('assets/img/home-bg.jpg') }}">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>My Blogging Platform</h1>
                            <span class="subheading">By Jan Alquero</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav" style="background-color: #343a40; background-image: {{ url('/assets/img/home-bg.jpg')}} ; background-size: cover;">
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
                    <li class="nav-item dropdown">
                        <a class="nav-link px-lg-3 py-3 py-lg-4 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #ffffff;">
                            Welcome, {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('user_profile') }}">My Profile</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('auth_logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link dropdown-item" style="color: #000000;">Logout</button>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


        
