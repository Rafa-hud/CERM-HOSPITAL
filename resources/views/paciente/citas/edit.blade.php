@extends('layouts.paciente')

@section('content')
<div class="container">
    <h1>Editar Cita</h1>
    <form action="{{ route('paciente.citas.update', $cita->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="curp">CURP</label>
            <input type="text" name="curp" class="form-control" value="{{ $cita->curp }}" required>
        </div>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ $cita->email }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_cita">Fecha de la Cita</label>
            <input type="date" name="fecha_cita" class="form-control" value="{{ $cita->fecha_cita }}" required>
        </div>
        <div class="form-group">
            <label for="hora_cita">Hora de la Cita</label>
            <input type="time" name="hora_cita" class="form-control" value="{{ $cita->hora_cita }}" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo de la Cita</label>
            <textarea name="motivo" class="form-control">{{ $cita->motivo }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Cita</button>
    </form>
</div>
@endsection
