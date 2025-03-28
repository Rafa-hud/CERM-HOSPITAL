<!-- resources/views/doctor/citas/updateEstado.blade.php -->
@extends('layouts.doctor')

@section('title', 'Actualizar Estado de las Citas')

@section('content')
<div class="container mt-5">
    <h1>Actualizar Estado de las Citas</h1>

    <form action="{{ route('doctor.citas.updateEstado') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>CURP</th>
                    <th>Email</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                    <tr>
                        <td>{{ $cita->curp }}</td>
                        <td>{{ $cita->email }}</td>
                        <td>{{ $cita->fecha_cita }}</td>
                        <td>{{ $cita->hora_cita }}</td>
                        <td>{{ $cita->motivo }}</td>
                        <td>
                            <select name="citas[{{ $cita->id }}][estado]" class="form-control">
                                <option value="pendiente" {{ $cita->estado && $cita->estado->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="realizada" {{ $cita->estado && $cita->estado->estado == 'realizada' ? 'selected' : '' }}>Realizada</option>
                                <option value="no_realizada" {{ $cita->estado && $cita->estado->estado == 'no_realizada' ? 'selected' : '' }}>No Realizada</option>
                            </select>
                            <input type="hidden" name="citas[{{ $cita->id }}][id]" value="{{ $cita->id }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Guardar Estados
        </button>
    </form>
</div>
@endsection