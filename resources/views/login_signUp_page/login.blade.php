@extends('layout')
@section('content')
<style>
    body {
        background-color: rgb(240, 240, 240); /* Light grey background for contrast */
    }

    .card {
        transition: transform 0.2s; /* Subtle animation on hover */
    }

    .card:hover {
        transform: scale(1.02);
    }
</style>
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
    <form class="card w-50 p-4" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);" action="{{ route('loginMatch') }}" method="POST">
        @csrf
        <h1 class="text-center mb-4 text-primary">Login</h1>

        <div class="form-group mt-3">
            <label for="email" class="font-weight-bold">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group mt-3">
            <label for="password" class="font-weight-bold">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <a href="{{ route('password.request') }}" class="text-primary">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-primary mt-4 w-100">Login</button>

        <div class="text-center mt-3">
            <p class="text-muted">Don't have an account? <a href="" class="text-primary">Sign Up</a></p>
        </div>
    </form>
</div>
@endsection
