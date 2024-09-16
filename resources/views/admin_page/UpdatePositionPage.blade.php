@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        @foreach ($data as $user)
        <form class="container" method="post" action="{{ route('UpdatePosition',$user->id)}}">
            @csrf
            <h1>Update Positions Details</h1>
            
            <div class="form-group mt-2">
                <label for="name">Position Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            
            <div class="form-group mt-2">
                <label for="Salary">Salary</label>
                <input type="integer" class="form-control" id="Salary" name="Salary" value="{{$user->selary}}">
                @if ($errors->has('Salary'))
                    <span class="text-danger">{{ $errors->first('Salary') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
        @endforeach
    </div>
</main>
@endsection
