@extends('layouts.master')

@section('content')
<br><br>

{{-- Mensaje de éxito con SweetAlert2 --}}
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
@endif

<div class="container">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-user-tie me-2"></i> Registrar Catatologo
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.category.store')}}" method="POST">
                @csrf

                {{-- Nombre de la categoria --}}
                <div class="mb-3">
                    <label for="category_name" class="form-label">
                        <i class="fas fa-building me-1"></i> Nombre Categoria
                    </label>
                    <input type="text" 
                           class="form-control @error('category_name') is-invalid @enderror"
                           id="category_name" name="category_name"
                           value="{{ old('category_name') }}" required>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Descripción--}}
                <div class="mb-3">
                    <label for="description" class="form-label">
                        <i class="fas fa-user me-1"></i> Descripción
                    </label>
                    <input type="text" 
                           class="form-control @error('description') is-invalid @enderror"
                           id="description" name="description"
                           value="{{ old('description') }}">
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

             
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Guardar Proveedor
                    </button>
                    <a href="" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
