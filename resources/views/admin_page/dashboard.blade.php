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
                <a href="{{route('dashboard')}}" class="nav-link active" aria-current="page">Home</a>
            </li>
            <li>
                <a href="{{route('employee_list')}}" class="nav-link">Employee List</a>
            </li>
            <li>
                <a href="{{route('attendence')}}" class="nav-link">Attendence</a>
            </li>
            <li>
                <a class="nav-link" href="{{route('signup')}}"><i class="fa-regular fa-id-card"></i> Add Employee</a>
            </li>
        </ul>
    </div>
    <div class="content">
        <h1>Home Page</h1>
        <p>This is the main content area.</p>
    </div>
</main>
@endsection