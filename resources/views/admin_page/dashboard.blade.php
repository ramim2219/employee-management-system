@extends('layout')
@section('content')
<main>
    @include('sidebar_layout')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="content">
        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        <script>
            const xValues = {!! json_encode($employees->pluck('total_hours_worked')) !!};
            const yValues = {!! json_encode($employees->pluck('employee_name')) !!};
            const month = @json($employees[0]->present_month);
            // Define bar colors
            const barColors = Array(xValues.length).fill("blue"); // Change colors as needed

            // Generate the chart
            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: yValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: xValues
                    }]
                },
                options: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: `Employee Total Hours worked in ${month}`
                    }
                }
            });
        </script>
    </div>
</main>
@endsection