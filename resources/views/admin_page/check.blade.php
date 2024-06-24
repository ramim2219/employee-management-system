@extends('layout')

@section('content')
    <div class="container">
        <h1>Employee Data</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Date</th>
                    <th>Attendance</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employeesData as $employee)
                    <tr>
                        <td>{{ $employee['user_id'] }}</td>
                        <td>{{ $employee['date'] }}</td>
                        <td>{{ $employee['attendence']}}</td>
                        <td>{{ $employee['check_in'] }}</td>
                        <td>{{ $employee['check_out'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
