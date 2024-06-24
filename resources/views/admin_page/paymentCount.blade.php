@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <h2>Filter details for the sellary calculation</h2>
        <form action="{{route('paymentCountResult')}}" method="post" class="container">
            @csrf
            <div class="form-group">
                <label for="year" class="mr-2">Year</label>
                <select id="year" name="year" class="form-control" required>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <!-- Add more years as needed -->
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="exampleFormControlSelect1">Select Month</label>
                <select class="form-control" id="exampleFormControlSelect1" name="month">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="form-group mt-2">
                <label for="offday">Off Day</label>
                <input type="number" name="offday" id="offday" class="form-control">
            </div>
            <div class="form-group mt-2">
                <label for="hours_per_day">Hours Per Day</label>
                <input type="number" name="hours_per_day" id="hours_per_day" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</main>
@endsection