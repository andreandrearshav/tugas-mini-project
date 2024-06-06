@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col mt-4 mx-5 col-sm-5 d-flex justify-content-center align-items-center" style="overflow: hidden; height: 100px; width: 100px; border-radius: 50%;">
                <img src="{{ asset($user->profile_image ? 'storage/' . $user->profile_image : 'img/default-profile.png') }}" class="border border-light" style="height: 100%; object-fit: cover;" alt="">
            </div>
            
            <div class="col-8 mt-3 col-sm-9 d-flex flex-column justify-content-center">
                <div class="col-8 col-sm-9 d-flex align-items-center justify-content-between">
                    <h1 class="mb-0">{{ $user->name }}</h1>
                    <a href="{{ route('edit-profile') }}" class="text-decoration-none text-white">
                        <i data-feather="settings"></i>
                    </a>
                </div>
                <div class="d-flex mt-2 justify-content-start">
                    <p class="me-5">Follow</p>
                    <p class="me-5">Followers</p>
                    <p>Following</p>
                </div>
                <h3>{{ $user->name }}</h3>
                <p>{{ $user->bio }}</p>
            </div>
        </div>
    </div>
@endsection
