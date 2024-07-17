@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-center">Employee Positions</h2>
            <a href="{{ route('employee_position') }}" class="btn btn-success">Add New</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">Position</th>
                    <th scope="col">Hourly Salary</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @if ($position->isNotEmpty())
                    @foreach ($position as $item)
                        <tr class="text-center">
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->selary }}</td>
                            <td>
                                <a href="#" class="text-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#" class="text-danger delete-user">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">No positions available.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</main>
@endsection
