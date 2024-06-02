@extends('layout')
@section('content')
    <form class="container" action="{{route('loginMatch')}}" method="POST">
      @csrf
      <h1>Login Page</h1>
        <div class="form-group mt-2">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group mt-2">
            <label for="exampleInputPassword2">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
@endsection