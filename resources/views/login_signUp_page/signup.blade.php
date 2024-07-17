@extends('layout')

@section('content')
<main>
    <style>
        .form-control {
            border-radius: 0.5rem;
        }
        .btn-primary {
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
    
    @include('sidebar_layout')
    <div class="content">
        <div class="container mt-4">
            <h1 class="text-center mb-4">Add Employee</h1>
            <form method="post" action="{{route('registrationSave')}}" enctype="multipart/form-data" class="border p-4 shadow-sm rounded bg-light">
                @csrf

                <div class="form-group">
                    <label for="exampleInputName">User Name</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Enter name" name="name" required>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group mt-3">
                    <label for="exampleInputEmail1">User Email Address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group mt-3">
                    <label for="exampleInputPassword2">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary mt-4 w-100">Submit</button>
            </form>
        </div>
    </div>
</main>
@endsection
