<!-- resources/views/doctor/citas/show.blade.php -->
@extends('layouts.doctor')

@section('title', 'Detalles de la Cita')

@section('content')
<div class="container mt-5">
    <h1>Detalles de la Cita</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Paciente:</strong> {{ $cita->user->name }}</p>
            <p><strong>CURP:</strong> {{ $cita->curp }}</p>
            <p><strong>Email:</strong> {{ $cita->email }}</p>
            <p><strong>Fecha:</strong> {{ $cita->fecha_cita }}</p>
            <p><strong>Hora:</strong> {{ $cita->hora_cita }}</p>
            <p><strong>Motivo:</strong> {{ $cita->motivo }}</p>
            <p><strong>Estado:</strong>
                <span class="badge {{ $cita->estado && $cita->estado->estado == 'realizada' ? 'bg-success' : ($cita->estado && $cita->estado->estado == 'no_realizada' ? 'bg-danger' : 'bg-warning') }}">
                    {{ $cita->estado ? $cita->estado->estado : 'Pendiente' }}
                </span>
            </p>
            <a href="{{ route('doctor.citas.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@endsection