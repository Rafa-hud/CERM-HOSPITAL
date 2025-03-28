<!-- resources/views/doctor/citas/edit.blade.php -->
@extends('layouts.doctor')

@section('title', 'Editar Cita')

@section('content')
<div class="container mt-5">
    <h1>Editar Cita</h1>

    <form action="{{ route('doctor.citas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="user_id">Paciente</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id }}" {{ $cita->user_id == $paciente->id ? 'selected' : '' }}>{{ $paciente->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="curp">CURP</label>
            <input type="text" name="curp" id="curp" class="form-control" value="{{ $cita->curp }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $cita->email }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="fecha_cita">Fecha de la Cita</label>
            <input type="date" name="fecha_cita" id="fecha_cita" class="form-control" value="{{ $cita->fecha_cita }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="hora_cita">Hora de la Cita</label>
            <input type="time" name="hora_cita" id="hora_cita" class="form-control" value="{{ $cita->hora_cita }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="motivo">Motivo</label>
            <textarea name="motivo" id="motivo" class="form-control">{{ $cita->motivo }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Actualizar Cita
        </button>
    </form>
</div>
@endsection