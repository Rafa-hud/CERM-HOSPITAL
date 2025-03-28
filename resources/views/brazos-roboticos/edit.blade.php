@extends('layouts.app')

@section('title', 'Editar Brazo Robótico')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Brazo Robótico</h1>
        <a href="{{ route('brazos-roboticos.show', $brazo['id']) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Cancelar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('brazos-roboticos.update', $brazo['id']) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="modelo" class="col-md-4 col-form-label text-md-end">Modelo</label>
                    <div class="col-md-6">
                        <input id="modelo" type="text" 
                               class="form-control @error('modelo') is-invalid @enderror" 
                               name="modelo" value="{{ old('modelo', $brazo['modelo']) }}" required>
                        @error('modelo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fabricante" class="col-md-4 col-form-label text-md-end">Fabricante</label>
                    <div class="col-md-6">
                        <input id="fabricante" type="text" 
                               class="form-control @error('fabricante') is-invalid @enderror" 
                               name="fabricante" value="{{ old('fabricante', $brazo['fabricante']) }}" required>
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
                               name="user_id" value="{{ old('user_id', $brazo['user_id'] ?? '') }}">
                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Actualizar Brazo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection