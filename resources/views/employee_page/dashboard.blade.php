@extends('layout')
@section('content')
<style>
    main {
        display: flex;
        min-height: 100vh;
        font-family: Arial, sans-serif;
    }
    .sidebar {
        width: 250px;
        background-color: #343a40;
        color: #fff;
        padding: 20px;
    }
    .sidebar a {
        color: #fff;
        text-decoration: none;
        padding: 10px 0;
        display: block;
    }
    .sidebar a:hover {
        background-color: #495057;
    }
    .content {
        flex-grow: 1;
        padding: 20px;
        background-color: #f8f9fa;
    }
    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    .profile-header img {
        border-radius: 50%;
        margin-right: 20px;
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
    .profile-header h1 {
        font-size: 24px;
        color: #343a40;
    }
    .employee-info {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }
    .employee-info h2 {
        margin-bottom: 15px;
        font-size: 20px;
        color: #495057;
    }
    .employee-info ul {
        list-style-type: none;
        padding: 0;
    }
    .employee-info li {
        margin-bottom: 10px;
        font-size: 16px;
        color: #343a40;
    }
    .employee-info li strong {
        font-weight: bold;
    }
</style>
<main>
    @include('sidebar_layout')
    <div class="content">
        <div class="profile-header">
            <img src="{{ asset('storage/' . $employee->file) }}" alt="Employee Image">
            <h1>Welcome, {{ $employee->first_name }} {{ $employee->last_name }}</h1>
        </div>
        <div class="employee-info mt-4">
            <h2>Employee Information</h2>
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Address:</strong> {{ $employee->Address }}</li>
                <li><strong>Phone Number:</strong> {{ $employee->phone_number }}</li>
                <li><strong>Position:</strong> {{ $position->name }}</li>
                <li><strong>Employee ID:</strong> {{ $employee->employee_id }}</li>
            </ul>
        </div>
    </div>
</main>
@endsection
