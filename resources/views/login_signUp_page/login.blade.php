@extends('layout')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 90vh; background-color: rgb(93, 93, 91)">
    <form class="card w-50 p-3" style="background-color: rgb(209, 209, 209)" action="{{route('loginMatch')}}" method="POST">
        @csrf
        <h1>Login</h1>
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
</div>
@endsection