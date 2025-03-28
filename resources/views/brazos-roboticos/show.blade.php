@extends('layouts.app')

@section('title', 'Detalle del Brazo Robótico')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalles del Brazo Robótico</h1>
        <div>
            <a href="{{ route('brazos-roboticos.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
            <a href="{{ route('brazos-roboticos.edit', $brazo['id']) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Información del Brazo</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $brazo['id'] }}</p>
                    <p><strong>Modelo:</strong> {{ $brazo['modelo'] }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fabricante:</strong> {{ $brazo['fabricante'] }}</p>
                    <p><strong>Usuario Asignado:</strong> {{ $brazo['user_id'] ?? 'No asignado' }}</p>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Últimas Operaciones</h5>
                @if(isset($brazo['operaciones']) && count($brazo['operaciones']) > 0)
                    <ul class="list-group">
                        @foreach($brazo['operaciones'] as $operacion)
                            <li class="list-group-item">
                                {{ $operacion['nombre'] }} - {{ $operacion['fecha'] }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="alert alert-info">No hay operaciones registradas</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection