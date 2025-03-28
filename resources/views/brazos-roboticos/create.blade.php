@extends('layouts.app')

@section('title', 'Crear Nuevo Brazo Robótico')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crear Nuevo Brazo Robótico</h1>
        <a href="{{ route('admin.brazos-roboticos.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Cancelar
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.brazos-roboticos.store') }}" id="brazoForm">
                @csrf

                <div class="row mb-3">
                    <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo *</label>
                    <div class="col-md-6">
                        <input id="modelo" type="text" 
                               class="form-control @error('modelo') is-invalid @enderror" 
                               name="modelo" value="{{ old('modelo') }}" required
                               placeholder="Ej: Modelo X-2000">
                        @error('modelo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fabricante" class="col-md-4 col-form-label text-md-end">Fabricante *</label>
                    <div class="col-md-6">
                        <input id="fabricante" type="text" 
                               class="form-control @error('fabricante') is-invalid @enderror" 
                               name="fabricante" value="{{ old('fabricante') }}" required
                               placeholder="Ej: RoboTech Inc.">
                        @error('fabricante')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="user_id" class="col-md-4 col-form-label text-md-end">ID Usuario</label>
                    <div class="col-md-6">
                        <input id="user_id" type="number" 
                               class="form-control @error('user_id') is-invalid @enderror" 
                               name="user_id" value="{{ old('user_id') }}"
                               placeholder="Opcional">
                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirmacion" required>
                            <label class="form-check-label" for="confirmacion">
                                Confirmo que los datos son correctos
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="bi bi-save"></i> Guardar Brazo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('brazoForm');
    const submitBtn = document.getElementById('submitBtn');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass"></i> Guardando...';
        
        // Enviar el formulario
        this.submit();
    });
});
</script>
@endsection