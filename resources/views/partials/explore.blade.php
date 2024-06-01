@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <img src="{{ asset('img/logo-medsos.png') }}" class="text-center" alt="" style="width: 60px; height: 40px">
        <div class="col-md-10 mt-5 d-flex justify-content-between">
            <!-- Search Section -->
            <div class="col-md-6 mt-5">
                <div class="position-sticky" style="top: 100px;">
                    <h2>Search</h2>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search comments..." aria-label="Search comments" aria-describedby="button-search">
                        <button class="btn btn-outline-secondary" type="button" id="button-search">Search</button>
                    </div>
                </div>
            </div>
            <!-- Follow Section -->
            <div class="col-md-5 mt-5">
                <div class="position-sticky" style="top: 100px;">
                    <h2>Siapa yang harus diikuti</h2>
                    <ul class="list-unstyled">
                        @foreach ($usersToFollow as $user)
                            <li class="d-flex align-items-center mb-2">
                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-fluid rounded-circle me-2" style="width: 50px; height: 50px;" alt="Profile Image">
                                @else
                                    <img src="{{ asset('img/profile.png') }}" class="img-fluid rounded-circle me-2" style="width: 50px; height: 50px;" alt="">
                                @endif
                                <span>{{ $user->name }}</span>
                                <span class="ms-auto">
                                    <form action="{{ route('follow', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Follow</button>
                                    </form>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
