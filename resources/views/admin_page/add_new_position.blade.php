@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <div class="container">
            <form method="post" action="{{route('positionSave')}}" enctype="multipart/form-data">
                @csrf
                <h1 class="mb-4">Add New Position</h1>
                <div class="form-group mt-2">
                    <label for="exampleInputName" class="form-label">Position Name</label>
                    <input type="text" class="form-control" id="exampleInputName" placeholder="Enter name" name="name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group mt-3">
                    <label for="exampleSelary" class="form-label">Position Hourly Salary</label>
                    <input type="number" class="form-control" id="exampleSelary" placeholder="Enter salary" name="selary">
                    @if ($errors->has('selary'))
                        <span class="text-danger">{{ $errors->first('selary') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>
</main>
@endsection
