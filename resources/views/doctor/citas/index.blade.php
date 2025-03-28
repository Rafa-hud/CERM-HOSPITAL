@extends('layouts.doctor')

@section('title', 'Listado de Citas')

@section('content')
<div class="container mt-5">
    <h1>Listado de Citas</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>CURP</th>
                <th>Email</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
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
                        <span class="badge {{ $cita->estado && $cita->estado->estado == 'realizada' ? 'bg-success' : 'bg-warning' }}">
                            {{ $cita->estado ? $cita->estado->estado : 'Pendiente' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('doctor.citas.edit', $cita->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('doctor.citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('doctor.citas.create') }}" class="btn btn-primary">Agregar Cita</a>
</div>
@endsection