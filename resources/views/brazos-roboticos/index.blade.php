@extends('layouts.app')

@section('title', 'Listado de Brazos Robóticos')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Brazos Robóticos</h1>
        <a href="{{ route('admin.brazos-roboticos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Brazo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Fabricante</th>
                    <th>Usuario</th>
                    <th>Creado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brazos as $brazo)
                    <tr>
                        <td>{{ $brazo['id'] }}</td>
                        <td>{{ $brazo['modelo'] }}</td>
                        <td>{{ $brazo['fabricante'] }}</td>
                        <td>{{ $brazo['user_id'] ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($brazo['created_at'])->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.brazos-roboticos.show', $brazo['id']) }}" 
                                   class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.brazos-roboticos.edit', $brazo['id']) }}" 
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.brazos-roboticos.destroy', $brazo['id']) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay brazos robóticos registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endsection