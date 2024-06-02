@extends('layouts.main')
@section('register')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <div class="card">
                <h1 class="text-center">Register</h1>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="username">User Name:</label>
                            <input type="text" class="form-control mt-3" id="username" name="username" required autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control mt-3" id="name" name="name" required autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control mt-3" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control mt-3" id="password" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" class="form-control mt-3" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3 w-100">Login</button>
                        <p class="text-center">Sudah punya akun ? 
                            <a href="{{ route('login') }}">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="bg-body-tertiary text-center ">
    <!-- Grid container -->
    <div class="container p-4"></div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-3 text-dark" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2020 Copyright:
      <a class="text-body  ms-2" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
@endsection