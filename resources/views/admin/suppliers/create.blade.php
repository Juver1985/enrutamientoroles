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
                <i class="fas fa-user-tie me-2"></i> Registrar Proveedor
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.suppliers.store') }}" method="POST">
                @csrf

                {{-- Nombre del Proveedor --}}
                <div class="mb-3">
                    <label for="supplier_name" class="form-label">
                        <i class="fas fa-building me-1"></i> Nombre del Proveedor
                    </label>
                    <input type="text" 
                           class="form-control @error('supplier_name') is-invalid @enderror"
                           id="supplier_name" name="supplier_name"
                           value="{{ old('supplier_name') }}" required>
                    @error('supplier_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nombre de Contacto --}}
                <div class="mb-3">
                    <label for="contact_name" class="form-label">
                        <i class="fas fa-user me-1"></i> Nombre de Contacto
                    </label>
                    <input type="text" 
                           class="form-control @error('contact_name') is-invalid @enderror"
                           id="contact_name" name="contact_name"
                           value="{{ old('contact_name') }}">
                    @error('contact_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone me-1"></i> Teléfono
                    </label>
                    <input type="text" 
                           class="form-control @error('phone') is-invalid @enderror"
                           id="phone" name="phone"
                           value="{{ old('phone') }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-1"></i> Correo Electrónico
                    </label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Dirección --}}
                <div class="mb-3">
                    <label for="address" class="form-label">
                        <i class="fas fa-map-marker-alt me-1"></i> Dirección
                    </label>
                    <input type="text" 
                           class="form-control @error('address') is-invalid @enderror"
                           id="address" name="address"
                           value="{{ old('address') }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botones --}}
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
