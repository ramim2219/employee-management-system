@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content container mt-4">
        @php
            $months = [
                1 => "January",
                2 => "February",
                3 => "March",
                4 => "April",
                5 => "May",
                6 => "June",
                7 => "July",
                8 => "August",
                9 => "September",
                10 => "October",
                11 => "November",
                12 => "December"
            ];
        @endphp
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Total Salary</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlySalaries as $salary)
                    <tr>
                        <td>{{ $salary->employee_id }}</td>
                        <td>{{ $salary->employee_name }}</td>
                        <td>{{ $months[(int)$salary->month] }}</td>
                        <td>{{ $salary->year }}</td>
                        <td>{{ $salary->total_salary }}</td>
                        <td class="text-center">
                            @if($salary->payment_status == 0)
                                <button type="submit" class="btn btn-danger btn-sm">Unpaid</button>
                            @else
                                <button type="button" class="btn btn-secondary btn-sm" disabled>Paid</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
