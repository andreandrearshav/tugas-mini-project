@extends('layouts.main')
@section('login')
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <h1 class="text-center">Login</h1>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control mt-3" id="email" name="email" required autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control mt-3" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3 w-100">Login</button>
                            <p class="text-center">Belum punya akun ? 
                                <a href="{{ route('register') }}">Register</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection