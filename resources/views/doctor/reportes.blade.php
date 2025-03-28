<!-- resources/views/doctor/reportes.blade.php -->
@extends('layouts.doctor')

@section('content')
<div class="container">
    <h1>Reportes de Citas Exitosas</h1>

    <!-- Gráfico de citas exitosas -->
    <div class="chart-container" style="position: relative; height: 400px; width: 800px;">
        <canvas id="citasExitosasChart"></canvas>
    </div>
</div>

<!-- Script para el gráfico -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('citasExitosasChart').getContext('2d');

        // Datos dinámicos (puedes reemplazar esto con datos reales desde el backend)
        const data = {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'],
            datasets: [{
                label: 'Citas Exitosas',
                data: [12, 19, 3, 5, 2, 3, 15], // Datos de ejemplo
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar', // Tipo de gráfico (puede ser 'line', 'pie', etc.)
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Citas Exitosas por Mes'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const citasExitosasChart = new Chart(ctx, config);
    });
</script>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('citasExitosasChart').getContext('2d');

        // Datos dinámicos desde el backend
        const data = {
            labels: {!! json_encode(array_keys($citasExitosas)) !!},
            datasets: [{
                label: 'Citas Exitosas',
                data: {!! json_encode(array_values($citasExitosas)) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar', // Tipo de gráfico
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Citas Exitosas por Mes'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        const citasExitosasChart = new Chart(ctx, config);
    });
</script>