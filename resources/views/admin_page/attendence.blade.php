@extends('layout')

@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <div class="container">
            <h1 class="mb-4">Employee Attendance</h1>
            <form action="{{ route('EmployeeAttendenceSave') }}" method="post">
                @csrf
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Attendance</th>
                            <th scope="col">Check In</th>
                            <th scope="col">Check Out</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $data->count(); $i++)
                            <tr>
                                <th scope="row">
                                    <input type="hidden" class="form-control" value="{{ $data[$i]->employee_id }}" name="employee[{{ $i }}][user_id]">
                                    <input type="text" class="form-control" value="{{ $data[$i]->employee_id }}" disabled>
                                </th>
                                <td>
                                    <input type="text" class="form-control" value="{{ $data[$i]->first_name }} {{ $data[$i]->last_name }}" disabled>
                                </td>
                                <td>
                                    <select id="attendance" name="employee[{{ $i }}][attendence]" class="form-control" required>
                                        <option value="" disabled>Select Attendance</option>
                                        <option value="1" {{ isset($data[$i]['attendence']) && $data[$i]['attendence'] == '1' ? 'selected' : '' }}>Present</option>
                                        <option value="0" {{ isset($data[$i]['attendence']) && $data[$i]['attendence'] == '0' ? 'selected' : '' }}>Absent</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="employee[{{ $i }}][check_in]" required>
                                </td>
                                <td>
                                    <input type="time" class="form-control" name="employee[{{ $i }}][check_out]" required>
                                </td>
                                <td>
                                    <input type="date" name="employee[{{ $i }}][date]" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
