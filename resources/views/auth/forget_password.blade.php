@extends('layout')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 90vh; background-color: rgb(93, 93, 91)">
    <form class="card w-50 p-3" style="background-color: rgb(209, 209, 209)" action="{{ route('password.email') }}" method="POST">
        @csrf
        <h1>Forgot Password</h1>
        <div class="form-group mt-2">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-2">Send Reset Link</button>
    </form>
</div>
@endsection
