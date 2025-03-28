<!-- resources/views/paciente/historial/show.blade.php -->
@extends('layouts.patiente')

@section('content')
<div class="container">
    <h1>Mi Historial Médico</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Resumen de Consultas</h5>
            <p class="card-text">{{ $historial->resumen_consultas }}</p>
            <h5 class="card-title">Recetas y Medicamentos</h5>
            <p class="card-text">{{ $historial->recetas_medicamentos }}</p>
            <h5 class="card-title">Alergias y Condiciones</h5>
            <p class="card-text">{{ $historial->alergias_condiciones }}</p>
            <h5 class="card-title">Informes de Hospitalización</h5>
            <p class="card-text">{{ $historial->informes_hospitalizacion }}</p>
            <h5 class="card-title">Plan de Tratamiento</h5>
            <p class="card-text">{{ $historial->plan_tratamiento }}</p>
            <h5 class="card-title">Comunicaciones</h5>
            <p class="card-text">{{ $historial->comunicaciones }}</p>
        </div>
    </div>
</div>
@endsection