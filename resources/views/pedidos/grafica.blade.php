@extends('layouts.panelAdministracion')

@section('title', 'Gráfica de Pedidos')

@section('content')


        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Total de ganancias por dia</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar', // Tipo de gráfica
                data: {
                    labels: @json($dates), // Las fechas
                    datasets: [{
                        label: 'Total',
                        data: @json($totals), // Los totales
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
        });
    </script>
@endsection

@section('footer')
    ©️ Cervezas Killer
@endsection
