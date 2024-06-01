{{-- @extends('layouts.main')
@section('name')
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
@endsection --}}