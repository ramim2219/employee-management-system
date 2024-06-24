@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <form class="container" method="post" action="{{route('registrationSave')}}">
            @csrf
            <h1>Add employee</h1>
            <div class="form-group mt-2">
              <label for="exampleInputName">User name</label>
              <input type="text" class="form-control" id="exampleInputName" placeholder="Enter name" name="name">
              @if ($errors->has('name'))
                  <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">User Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputPassword2">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" name="password_confirmation">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</main>
@endsection