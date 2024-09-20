@extends('layout')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 90vh; background-color: rgb(93, 93, 91)">
    <form class="card w-50 p-3" style="background-color: rgb(209, 209, 209)" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <h1>Reset Password</h1>
        <div class="form-group mt-2">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group mt-2">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group mt-2">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Reset Password</button>
    </form>
</div>
@endsection
