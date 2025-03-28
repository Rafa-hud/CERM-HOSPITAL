<!-- resources/views/doctor/historial/edit.blade.php -->
@extends('layouts.doctor')

@section('content')
<div class="container">
    <h1>Editar Historial Médico</h1>
    <form action="{{ route('doctor.historial.update', $historial->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">Paciente</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $historial->user_id == $paciente->id ? 'selected' : '' }}>{{ $paciente->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="resumen_consultas">Resumen de Consultas</label>
            <textarea name="resumen_consultas" id="resumen_consultas" class="form-control">{{ $historial->resumen_consultas }}</textarea>
        </div>
        <div class="form-group">
            <label for="recetas_medicamentos">Recetas y Medicamentos</label>
            <textarea name="recetas_medicamentos" id="recetas_medicamentos" class="form-control">{{ $historial->recetas_medicamentos }}</textarea>
        </div>
        <div class="form-group">
            <label for="alergias_condiciones">Alergias y Condiciones</label>
            <textarea name="alergias_condiciones" id="alergias_condiciones" class="form-control">{{ $historial->alergias_condiciones }}</textarea>
        </div>
        <div class="form-group">
            <label for="informes_hospitalizacion">Informes de Hospitalización</label>
            <textarea name="informes_hospitalizacion" id="informes_hospitalizacion" class="form-control">{{ $historial->informes_hospitalizacion }}</textarea>
        </div>
        <div class="form-group">
            <label for="plan_tratamiento">Plan de Tratamiento</label>
            <textarea name="plan_tratamiento" id="plan_tratamiento" class="form-control">{{ $historial->plan_tratamiento }}</textarea>
        </div>
        <div class="form-group">
            <label for="comunicaciones">Comunicaciones</label>
            <textarea name="comunicaciones" id="comunicaciones" class="form-control">{{ $historial->comunicaciones }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Historial</button>
    </form>
</div>
@endsection