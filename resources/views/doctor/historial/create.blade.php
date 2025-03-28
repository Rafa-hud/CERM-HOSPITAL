<!-- resources/views/doctor/historial/create.blade.php -->
@extends('layouts.doctor')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nuevo Historial Médico</h1>

    <!-- Mensajes de validación o errores -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para crear un nuevo historial médico -->
    <form action="{{ route('doctor.historial.store') }}" method="POST">
        @csrf

        <!-- Selección de paciente -->
        <div class="form-group mb-3">
            <label for="user_id" class="form-label">Paciente</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Seleccione un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ old('user_id') == $paciente->id ? 'selected' : '' }}>
                        {{ $paciente->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Resumen de consultas -->
        <div class="form-group mb-3">
            <label for="resumen_consultas" class="form-label">Resumen de Consultas</label>
            <textarea name="resumen_consultas" id="resumen_consultas" class="form-control" rows="3">{{ old('resumen_consultas') }}</textarea>
        </div>

        <!-- Recetas y medicamentos -->
        <div class="form-group mb-3">
            <label for="recetas_medicamentos" class="form-label">Recetas y Medicamentos</label>
            <textarea name="recetas_medicamentos" id="recetas_medicamentos" class="form-control" rows="3">{{ old('recetas_medicamentos') }}</textarea>
        </div>

        <!-- Alergias y condiciones -->
        <div class="form-group mb-3">
            <label for="alergias_condiciones" class="form-label">Alergias y Condiciones</label>
            <textarea name="alergias_condiciones" id="alergias_condiciones" class="form-control" rows="3">{{ old('alergias_condiciones') }}</textarea>
        </div>

        <!-- Informes de hospitalización -->
        <div class="form-group mb-3">
            <label for="informes_hospitalizacion" class="form-label">Informes de Hospitalización</label>
            <textarea name="informes_hospitalizacion" id="informes_hospitalizacion" class="form-control" rows="3">{{ old('informes_hospitalizacion') }}</textarea>
        </div>

        <!-- Plan de tratamiento -->
        <div class="form-group mb-3">
            <label for="plan_tratamiento" class="form-label">Plan de Tratamiento</label>
            <textarea name="plan_tratamiento" id="plan_tratamiento" class="form-control" rows="3">{{ old('plan_tratamiento') }}</textarea>
        </div>

        <!-- Comunicaciones -->
        <div class="form-group mb-3">
            <label for="comunicaciones" class="form-label">Comunicaciones</label>
            <textarea name="comunicaciones" id="comunicaciones" class="form-control" rows="3">{{ old('comunicaciones') }}</textarea>
        </div>

        <!-- Botón para guardar el historial -->
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar Historial
            </button>
            <a href="{{ route('doctor.historial.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection