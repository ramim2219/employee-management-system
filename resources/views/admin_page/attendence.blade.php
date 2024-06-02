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
                <a href="{{route('dashboard')}}" class="nav-link">Home</a>
            </li>
            <li>
                <a href="{{route('employee_list')}}" class="nav-link">Employee List</a>
            </li>
            <li>
                <a href="{{route('attendence')}}" class="nav-link active" aria-current="page">Attendence</a>
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
                        <th scope="col">Name</th>
                        <th scope="col">Attendence</th>
                        <th scope="col">Check In</th>
                        <th scope="col">Check Out</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('EmployeeAttendenceSave')}}" method="post">
                        {{-- {{$data->count()}} --}}
                        @csrf
                        @for ($i=0 ; $i<$data->count() ; $i++)
                            <tr>
                                <th scope="row">
                                    <input type="hidden" class="form-control" value="{{$data[$i]->employee_id}}" name="employee[{{$i}}][user_id]" >
                                    <input type="text" class="form-control" value="{{$data[$i]->employee_id}}" disabled>
                                </th>
                                <td>
                                    <input type="text" class="form-control" value="{{$data[$i]->first_name}} {{$data[$i]->last_name}}" disabled>
                                </td>
                                <td>
                                    <select id="attendance" name="employee[{{$i}}][attendence]" class="form-control" required>
                                        <option value="" disabled>Select Attendance</option>
                                        <option value="1" {{ isset($data[$i]['attendence']) && $data[$i]['attendence'] == '1' ? 'selected' : '' }}>Present</option>
                                        <option value="0" {{ isset($data[$i]['attendence']) && $data[$i]['attendence'] == '0' ? 'selected' : '' }}>Absent</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="employee[{{$i}}][check_in]">
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="employee[{{$i}}][check_out]">
                                </td>
                                <td>
                                    <input type="date" name="employee[{{$i}}][date]" class="form-control" value="{{ date('Y-m-d') }}">
                                </td>
                            </tr>
                        @endfor
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </tbody>
            </table>
    </div>
</main>
@endsection