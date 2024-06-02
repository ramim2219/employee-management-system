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
                <a href="{{route('employee_list')}}" class="nav-link active" aria-current="page">
                    Employee List
                </a>
            </li>
            <li>
                <a href="{{route('attendence')}}" class="nav-link">
                    Attendence
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{route('signup')}}"><i class="fa-regular fa-id-card"></i> Add Employee</a>
            </li>
        </ul>
    </div>
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