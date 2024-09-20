@extends('layout')

@section('content')
<main>
    @include('sidebar_layout')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="content">
        <div class="container2">
            <h2 class="text-center mb-4">Employee Total Hours Worked In This Month</h2>
            <canvas id="myChart" style="width:100%; max-width:800px;"></canvas>
            <script>
                @if(isset($employees) && $employees->isNotEmpty())
                    const xValues = {!! json_encode($employees->pluck('total_hours_worked')) !!};
                    const yValues = {!! json_encode($employees->pluck('employee_name')) !!};
                    const month = @json($employees->first()->present_month);

                    // Generate unique colors for each bar
                    const barColors = xValues.map((_, index) => `hsl(${index * 30}, 100%, 50%)`);

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
                            plugins: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: `Employee Total Hours Worked in ${month}`,
                                    font: {
                                        size: 20,
                                        weight: 'bold',
                                    },
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total Hours',
                                        font: {
                                            size: 14,
                                        }
                                    },
                                    ticks: {
                                        color: '#495057',
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Employees',
                                        font: {
                                            size: 14,
                                        }
                                    },
                                    ticks: {
                                        color: '#495057',
                                    }
                                }
                            }
                        }
                    });
                @else
                    console.warn('No employee data available to display the chart.');
                @endif
            </script>
        </div>
    </div>
</main>

<style>
    .content {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .container2 {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    h2 {
        color: #343a40;
    }
</style>
@endsection
