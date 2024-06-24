<!-- resources/views/employeeDetails.blade.php -->
@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <form class="container" method="post" action="{{ route('employeeDetailsSave',$id) }}">
            @csrf
            <h1>Submit employee more details</h1>
            
            <div class="form-group mt-2">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Enter first name" name="first_name" value="{{ old('first_name') }}">
                @if ($errors->has('first_name'))
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
            
            <div class="form-group mt-2">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Enter last name" name="last_name" value="{{ old('last_name') }}">
                @if ($errors->has('last_name'))
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
            
            <div class="form-group mt-2">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="{{ old('address') }}">
                @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
            </div>
            
            <div class="form-group mt-2">
                <label for="phoneNumber">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" placeholder="Enter phone number" name="phone_number" value="{{ old('phone_number') }}">
                @if ($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</main>

@endsection
