@extends('layouts.paciente')

@section('content')
<div class="container">
    <h1>Detalles de la Cita</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">CURP: {{ $cita->curp }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $cita->email }}</p>
            <p class="card-text"><strong>Fecha:</strong> {{ $cita->fecha_cita }}</p>
            <p class="card-text"><strong>Hora:</strong> {{ $cita->hora_cita }}</p>
            <p class="card-text"><strong>Motivo:</strong> {{ $cita->motivo }}</p>
            <a href="{{ route('paciente.citas.edit', $cita->id) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('paciente.citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
    <a href="{{ route('paciente.citas.index') }}" class="btn btn-secondary mt-3">Volver al Listado</a>
</div>
@endsection