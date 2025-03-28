@extends('layouts.doctor')

@section('content')
<div class="container">
    <h1>Historial de Pacientes</h1>

    <!-- Botón para agregar un nuevo paciente -->
    <div class="mb-3">
        <a href="{{ route('doctor.historial.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar Paciente
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historiales as $historial)
                <tr>
                    <td>{{ $historial->user->name }}</td>
                    <td>
                        <a href="{{ route('doctor.historial.show', $historial->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('doctor.historial.edit', $historial->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('doctor.historial.destroy', $historial->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection