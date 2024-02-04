@extends('layouts.panelAdministracion')

@section('title', 'Estadisticas')

@section('content')


        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Total de ganancias por dia y mes</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart').getContext('2d');
            const ctx2 = document.getElementById('myChart2').getContext('2d');

            // Datos para la gráfica de barras
            const dates = @json($dates);
            const totals = @json($totals);

            const meses = @json($meses);
            const mesesTotal = @json($totalMes);


            // Crear la gráfica de barras
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Total',
                        data: totals,
                        backgroundColor: 'rgba(0, 123, 255, 0.5)',
                        borderColor: 'rgba(0, 123, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            // Crear la gráfica de pastel
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: meses,
                    datasets: [{
                        data: mesesTotal,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
@endsection

@section('footer')
    ©️ Cervezas Killer
@endsection
