@extends('layouts.master')

@section('content')
    <div>
        <canvas id="gradesChart" width="200" height="200"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('gradesChart').getContext('2d');
            const chartData = @json($chartData);

            const labels = chartData.labels;
            const data = chartData.data;

            const chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Student Performance',
                        data: data,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.5)', // Color for "Passed"
                            'rgba(255, 99, 132, 0.5)'  // Color for "Failed"
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',   // Border color for "Passed"
                            'rgba(255, 99, 132, 1)'    // Border color for "Failed"
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    </div>
@endsection