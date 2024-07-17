@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        @foreach ($data as $user)
        <form class="container" method="post" action="{{ route('updateEmployee',$user->employee_id)}}" enctype="multipart/form-data">
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
            <div class="form-group mt-2">
                <label for="position">Position</label>
                <select class="form-control" id="position" name="position_id">
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ $user->employee_position == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('position_id'))
                    <span class="text-danger">{{ $errors->first('position_id') }}</span>
                @endif
            </div>
            <div class="mb-3 row">
                <div class="col-md-4">
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage/' . $user->file) }}" alt="Student Image" width="200" id="output">
                </div>
                <div class="col-md-8">
                    <label for="image" class="form-label">Change Image</label>
                    <input type="file" class="form-control" id="image" aria-describedby="imageHelp" name="image" accept=".jpg,.png,.jpeg" onchange="document.querySelector('#output').src=window.URL.createObjectURL(this.files[0])">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
        @endforeach
    </div>
</main>
@endsection