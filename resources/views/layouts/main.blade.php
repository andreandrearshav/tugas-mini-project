<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
         body {
            background-color: #000;
            color: #fff;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1;
            overflow-x: hidden;
            padding-top: 20px;
            color: #fff
        }
        .main-content {
            margin-left: 200px;
            padding: 20px;
        }
        .transparent-input {
            background-color: transparent;
            border: 1px solid #ccc; 
            color: #000; 
        }
    </style>
</head>
<body>
    {{-- <div class="row">
        <div class="col-md-2 bg-light sidebar">
            <div class="profile mt-3 mb-3 d-flex align-items-center">
                <div class="border rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                    <img class="img-fluid" src="{{ asset('img/profile.png') }}" alt="">
                </div>
                <div class="profile-info ms-2">
                    <a href="" class="d-block text-truncate nav-link" style="max-width: 150px;">
                        {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                    </a>
                    <a href="" class="d-block text-truncate" style="max-width: 150px;">
                        {{ session('username') ? session('username') : '' }}
                    </a>
                </div>
            </div>

            <ul class="nav flex-column">
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('home') }}">
                            <i data-feather="home" class="me-2"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('explore') }}">
                            <i data-feather="search" class="me-2"></i>
                            <span>Explore</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i data-feather="bell" class="me-2"></i>
                            <span>Notifications</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('posting') }}">
                            <i data-feather="plus-circle" class="me-2"></i>
                            <span>Posting</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i data-feather="bookmark" class="me-2"></i>
                            <span>Bookmark</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i data-feather="arrow-left" class="me-2"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i data-feather="home" class="me-2"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i data-feather="search" class="me-2"></i>
                            <span>Explore</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('login') }}">
                            <i data-feather="arrow-left" class="me-2"></i>
                            <span>Login</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="col-md-10 main-content">
            @yield('content')
        </div>
        <div class="col-md-10 main-content">
            @yield('post')
        </div>
    </div> --}}
    @if (Request::is('login','register'))
        @yield('login')
        @yield('register')
    @else
    <div class="row">
        <div class="col-md-2 bg-light sidebar">
            <!-- Sidebar -->
            <div class="col-md-2 bg-light sidebar bg-dark">
                <div class="profile mt-3 mb-3 d-flex align-items-center">
                    <div class="border rounded-circle ms-3" style="width: 50px; height: 50px; overflow: hidden; object-fit: cover">
                    <a href="{{ route('profile') }}">
                        @if (Auth::check())
                            
                        <img class="img-fluid" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('img/profile.png') }}" alt="">
                        @endif
                    </a>
                    </div>
                    <div class="profile-info ms-2">
                        <a href="{{ route('profile') }}" class="d-block text-truncate nav-link text-white" style="max-width: 150px;">
                            {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                        </a>
                        <a href="{{ route('profile') }}" class="d-block text-truncate" style="max-width: 150px;">
                            {{ session('username') ? session('username') : '' }}
                        </a>
                    </div>
                </div>
            
                <ul class="nav flex-column">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('home') }}">
                                <i data-feather="home" class="me-2"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('explore') }}">
                                <i data-feather="search" class="me-2"></i>
                                <span>Explore</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <i data-feather="bell" class="me-2"></i>
                                <span>Notifications</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('posting') }}">
                                <i data-feather="plus-circle" class="me-2"></i>
                                <span>Posting</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <i data-feather="bookmark" class="me-2"></i>
                                <span>Bookmark</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="arrow-left" class="me-2"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('home') }}">
                                <i data-feather="home" class="me-2"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('explore') }}">
                                <i data-feather="search" class="me-2"></i>
                                <span>Explore</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">
                                <i data-feather="arrow-left" class="me-2"></i>
                                <span>Login</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-10 tb-4 main-content">
            @yield('sidebar')
            @yield('content')
            @yield('post')
            @yield('home')
            @yield('comments')
        </div>
    </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
                
            

