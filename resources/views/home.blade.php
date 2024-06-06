@extends('layouts.main')

@section('home')
<div class="container-fluid">
    <div class="text-center">
        <img src="{{ asset('img/logo-medsos.png') }}" class="text-center" style="width: 50px">
    </div>
    <div class="mt-4 text-center position-sticky" style="margin-bottom: 40px">
        <a href="{{ route('home') }}" class="me-3 text-decoration-none text-white {{ Request::is('/') ? 'active' : '' }}" >For you</a>
        <a href="{{ route('following') }}" class="text-decoration-none text-white" {{ Request::is('following') ? 'active' : '' }} >Following</a>
    </div>
    <div class="row vh-100" style="overflow-y: auto;">
        <!-- Main Content -->
        <div class="col-md-6 mt-5">
            <div class="row">
                @if ($posts && $posts->count())
                    @foreach ($posts as $post)
                    <div class="col-12 mt-3 px-4 py-3">
                        <div class="card border border-dark mb-4 p-2 w-100">
                            <div class="profile mt-3 mb-0 d-flex align-items-center">
                                <div class="border border-dark rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                                    @if (Auth::check())
                                        
                                    <img class="img-fluid" style="object-fit: cover" src="{{ $post->user->profile_image ? asset('storage/' . $post->user->profile_image) : asset('img/profile.png') }}" alt="">
                                    {{-- <img class="img-fluid" style="object-fit: cover" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('img/profile.png') }}" alt=""> --}}
                                    @endif
                                </div>
                                <div class="profile-info ms-2">
                                    <span class="d-block">{{ $post->user->name }}</span>
                                </div>
                            </div>
                            <small class="text- text-dark fs-10 mb-2 text-dark-50">{{ $post->created_at->diffForHumans() }}</small>
                            <span class="d-block fw-semibold">{{ $post->caption }}</span>
                            @if ($post->image)
                            <a href="{{ route('comments', $post->id) }}">
                                <img class="rounded card-img-top" src="{{ asset('storage/' . $post->image) }}" alt="...">
                            </a>
                            <div class="border border-dark mt-4"></div>
                            <div class="card-body">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li class="d-flex align-items-center w-100">
                                        <a href="" class="like-button text-decoration-none text-dark" data-post-id="{{ $post->id }}">
                                            <i data-feather="heart" class="me-2 "></i>
                                        </a>
                                        <span >Like</span>
                                    </li>
                                    <li class="d-flex align-items-center w-100">
                                        <a href="{{ route('comments', $post->id) }}" class="text-decoration-none text-dark" data-post-id="{{ $post->id }}">
                                            <i data-feather="message-circle" class="me-2 like-icon"></i>
                                        </a>
                                        <span>Comment</span>
                                    </li>
                                    <li class="d-flex align-items-center w-100">
                                        <a href="" class="bookmark-button text-decoration-none text-dark" data-post-id="{{ $post->id }}">
                                            <i data-feather="bookmark" class="me-2 bookmark-icon"></i>
                                        </a>
                                        <span>Faforit</span>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-center">No posts available.</p>
                @endif
            </div>
        </div>
        
        <!-- Sidebar Content -->
        <div class="col-md-6 mt-5">
            <div class="position-sticky mx-2" style="top: 100px;">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h2>Siapa yang harus diikuti</h2>
                <ul class="list-unstyled">
                    @if(auth()->check())
                        @php
                            $followingUser = auth()->user()->following()->pluck('followed_id')->toArray();
                        @endphp
                    @endif
                    @foreach ($users as $user)
                        @if (auth()->check() && auth()->user()->following->contains($user->id))
                            <li class="d-flex align-items-center mb-2">
                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-fluid rounded-circle me-2" style="width: 50px; height: 50px;" alt="Profile Image">
                                @else
                                    <span>
                                        <img src="{{ asset('img/profile.png') }}" class="img-fluid border border-dark rounded-circle me-2" style="width: 50px; height: 50px;" alt="">
                                    </span>
                                @endif
                                <div class="d-flex flex-column flex-grow-1">
                                    <span>{{ $user->name }}</span>
                                </div>
                                <span class="ms-auto">
                                    <form action="{{ route('unfollow', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Unfollow</button>
                                    </form>
                                </span>
                            </li>
                        @endif
                    @endforeach
                    @foreach ($users as $user)
                        @if (!auth()->check() || !auth()->user()->following->contains($user->id))
                            <li class="d-flex align-items-center mb-2">
                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-fluid rounded-circle me-2" style="width: 50px; height: 50px;" alt="Profile Image">
                                @else
                                    <span>
                                        <img src="{{ asset('img/profile.png') }}" class="img-fluid border border-dark rounded-circle me-2" style="width: 50px; height: 50px;" alt="">
                                    </span>
                                @endif
                                <div class="d-flex flex-column flex-grow-1">
                                    <span>{{ $user->name }}</span>
                                </div>
                                <span class="ms-auto">
                                    <form action="{{ route('follow', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Follow</button>
                                    </form>
                                </span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 


<style>
    .like-icon.active,
    .bookmark-icon.active{
        color: red;
        fill: red;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // feather.replace();

        const likeButtons = document.querySelectorAll('.like-button');
        const bookmarkButtons = document.querySelectorAll('.bookmark-button');

        likeButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const likeIcon = this.querySelector('.like-icon');
                likeIcon.classList.toggle('active');
            });
        });

        bookmarkButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const bookmarkIcon = this.querySelector('.bookmark-icon');
                bookmarkIcon.classList.toggle('active');
            });
        });
    });
</script>



    


                
                

