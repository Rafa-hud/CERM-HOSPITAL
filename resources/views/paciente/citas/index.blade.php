@extends('layouts.paciente')

@section('content')
<div class="container">
    <h1>Mis Citas</h1>
    <a href="{{ route('paciente.citas.create') }}" class="btn btn-primary mb-3">Agendar Nueva Cita</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>CURP</th>
                <th>Email</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Motivo</th>
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
                        
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection