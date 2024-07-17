@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
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
        <h2>Payment status for {{$months[$month]}}, {{$year}}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Hours Worked</th>
                    <th>Overtime</th>
                    <th>Salary</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td>{{ $month }}/{{ $year }}</td>
                    <td>{{ $result->employee_id }}</td>
                    <td>{{ $result->first_name }} {{ $result->last_name }}</td>
                    <td>{{ $result->hours_worked }}</td>
                    <td>{{ $result->overtime }}</td>
                    <td>{{ $result->salary }}</td>
                    <td>
                        {{-- {{ route('pay.salary', $employee->employee_id) }} --}}
                        @if($result->payment_status == 0 )
                            <form action="{{ route('pay_monthly_bill', $result->employee_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Pay Salary</button>
                            </form>
                        @else
                            <button type="button" class="btn btn-secondary" disabled>Paid</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
