@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if ($employees->isNotEmpty())
                        @foreach ($employees as $employees)
                            <tr>
                                <th scope="row">{{$employees->employee_id}}</th>
                                <td>{{$employees->first_name}}</td>
                                <td>{{$employees->last_name}}</td>
                                <td>{{$employees->Address}}</td>
                                <td>{{$employees->phone_number}}</td>
                                <td class="text-center">
                                    <a href="{{route('UpdateEmployeePage',$employees->employee_id)}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{route('deleteEmployee',$employees->employee_id)}}">
                                        <i class="fa-solid fa-trash" ></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</main>
@endsection