@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <div class="content">
        <h1 class="text-center mb-4">Filter Details for Salary Calculation</h1>
        <form action="{{ route('paymentCountResult') }}" method="post" class="container border rounded p-4 shadow-sm bg-light">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="year" class="font-weight-bold">Year</label>
                        <select id="year" name="year" class="form-control" required>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <!-- Add more years as needed -->
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="month" class="font-weight-bold">Select Month</label>
                        <select class="form-control" id="month" name="month" required>
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
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="offday" class="font-weight-bold">Off Day</label>
                <input type="number" name="offday" id="offday" class="form-control" required placeholder="Enter Off Days">
            </div>

            <div class="form-group mt-3">
                <label for="hours_per_day" class="font-weight-bold">Hours Per Day</label>
                <input type="number" name="hours_per_day" id="hours_per_day" class="form-control" required placeholder="Enter Hours Per Day">
            </div>

            <button type="submit" class="btn btn-primary mt-4 w-100">Submit</button>
        </form>
    </div>
</main>
@endsection
