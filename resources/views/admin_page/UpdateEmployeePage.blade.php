@extends('layout')
@section('content')
<style>
    main {
        display: flex;
        min-height: 100vh;
    }
    .sidebar {
        width: 250px;
        background-color: #343a40;
        color: #fff;
    }
    .sidebar a {
        color: #fff;
        text-decoration: none;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .content {
        flex-grow: 1;
        padding: 20px;
    }
</style>
<main>
    <div class="sidebar d-flex flex-column p-3">
        <h2>Sidebar</h2>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link">
                    Home
                </a>
            </li>
            <li>
                <a href="{{route('employee_list')}}" class="nav-link">
                    Employee List
                </a>
            </li>
            <li>
                <a href="{{route('attendence')}}" class="nav-link">
                    Attendence
                </a>
            </li>
            <li>
                <a class="nav-link active" href="{{route('signup')}}" aria-current="page"><i class="fa-regular fa-id-card"></i> Add Employee</a>
            </li>
        </ul>
    </div>
    <div class="content">
        @foreach ($data as $user)
        <form class="container" method="post" action="{{ route('updateEmployee',$user->employee_id)}}">
            @csrf
            <h1>Update Employees Details</h1>
            
            <div class="form-group mt-2">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="first_name" value="{{$user->first_name}}">
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            
            <div class="form-group mt-2">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="last_name" value="{{$user->last_name}}">
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
            
            <div class="form-group mt-2">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{$user->Address}}">
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            
            <div class="form-group mt-2">
                <label for="phoneNumber">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" name="phone_number" value="{{$user->phone_number}}">
                @if ($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
        @endforeach
    </div>
</main>
@endsection