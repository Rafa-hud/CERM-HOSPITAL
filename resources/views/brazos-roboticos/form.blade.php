@if(isset($brazo))
    @php $isEdit = true; @endphp
    @php $formAction = route('admin.brazos-roboticos.update', $brazo['id']); @endphp
@else
    @php $isEdit = false; @endphp
    @php $formAction = route('admin.brazos-roboticos.store'); @endphp
@endif

@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="fas fa-robot"></i>
                {{ $isEdit ? 'Editar Brazo Robótico #'.$brazo['id'] : 'Nuevo Brazo Robótico' }}
            </h3>
        </div>

        <div class="card-body">
            <form action="{{ $formAction }}" method="POST">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="modelo">Modelo *</label>
                            <input type="text" class="form-control @error('modelo') is-invalid @enderror"
                                   id="modelo" name="modelo"
                                   value="{{ old('modelo', $brazo['modelo'] ?? '') }}" required>
                            @error('modelo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fabricante">Fabricante *</label>
                            <input type="text" class="form-control @error('fabricante') is-invalid @enderror"
                                   id="fabricante" name="fabricante"
                                   value="{{ old('fabricante', $brazo['fabricante'] ?? '') }}" required>
                            @error('fabricante')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">Usuario Asignado</label>
                            <select class="form-control select2 @error('user_id') is-invalid @enderror"
                                    id="user_id" name="user_id">
                                <option value="">Seleccione un usuario</option>
                                @foreach($users as $user)
                                <option value="{{ $user['id'] }}"
                                    {{ old('user_id', $brazo['user_id'] ?? '') == $user['id'] ? 'selected' : '' }}>
                                    {{ $user['name'] }} ({{ $user['email'] }})
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control @error('estado') is-invalid @enderror"
                                    id="estado" name="estado">
                                <option value="activo" {{ (old('estado', $brazo['estado'] ?? '') == 'activo') ? 'selected' : '' }}>Activo</option>
                                <option value="mantenimiento" {{ (old('estado', $brazo['estado'] ?? '') == 'mantenimiento') ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="inactivo" {{ (old('estado', $brazo['estado'] ?? '') == 'inactivo') ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_fabricacion">Fecha de Fabricación</label>
                            <input type="date" class="form-control @error('fecha_fabricacion') is-invalid @enderror"
                                   id="fecha_fabricacion" name="fecha_fabricacion"
                                   value="{{ old('fecha_fabricacion', $brazo['fecha_fabricacion'] ?? '') }}">
                            @error('fecha_fabricacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror"
                                      id="descripcion" name="descripcion"
                                      rows="3">{{ old('descripcion', $brazo['descripcion'] ?? '') }}</textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> {{ $isEdit ? 'Actualizar' : 'Guardar' }}
                    </button>
                    <a href="{{ route('admin.brazos-roboticos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Seleccione un usuario",
        allowClear: true
    });
});
</script>
@endsection
