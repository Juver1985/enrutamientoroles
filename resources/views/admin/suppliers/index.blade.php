@extends('layouts.master')

@section('content')

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: '¡Éxito!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    });
</script>
@endif
@if(session('danger'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            title: '¡Eliminado!',
            text: '{{ session("danger") }}',
            icon: 'error', // "error" da la alerta roja tipo danger
            confirmButtonText: 'Aceptar'
        });
    });
</script>

@endif

<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 90rem;">
        <h5 class="card-header text-center">Lista de Proveedores</h5>
        <div class="card-body">
            <table id="proveedores" class="table table-sm table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Id</th>
                        <th>Nombre Proveedor</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedor as $prov)
                    <tr class="text-center">
                        <td>{{ $prov->id }}</td>
                        <td>{{ $prov->supplier_name }}</td>
                        <td>{{ $prov->contact_name }}</td>
                        <td>{{ $prov->phone }}</td>
                        <td>{{ $prov->email }}</td>
                        <td>{{ $prov->address }}</td>
                        <td>
                            <button type="button" class="btn btn-success editbtn"
                                data-id="{{ $prov->id }}"
                                data-nombre="{{ $prov->supplier_name }}"
                                data-contacto="{{ $prov->contact_name }}"
                                data-telefono="{{ $prov->phone }}"
                                data-mail="{{ $prov->email }}"
                                data-dir="{{ $prov->address }}"
                                data-bs-toggle="modal" data-bs-target="#editar">
                              <i class="fas fa-pen"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger deletebtn"
                                data-id="{{ $prov->id }}"
                                data-bs-toggle="modal" data-bs-target="#eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Edición -->
<div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('admin.suppliers.update', ':id') }}" id="formEditar" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-nombre" class="form-label">Nombre Proveedor</label>
                        <input type="text" class="form-control" id="edit-nombre" name="supplier_name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-contacto" class="form-label">Contacto</label>
                        <input type="text" class="form-control" id="edit-contacto" name="contact_name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="edit-telefono" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="edit-mail" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="edit-mail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="edit-dir" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="edit-dir" name="address">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Eliminación -->
<div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
  <form action="{{ route('admin.suppliers.destroy', ':id') }}" id="formEliminar" method="POST">
  @csrf
  @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete-id">
                    <p>¿Estás seguro de que deseas eliminar este proveedor?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  // 1) Tomamos la ruta desde Blade con placeholder
  const updateRouteTpl = @json(route('admin.suppliers.update', ':id')); 
  // Quedará como "/admin/suppliers/update/:id"

  // 2) Al abrir el modal, reemplazamos :id por el real
  document.querySelectorAll('.editbtn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;

      // Construir action correcto según la ruta nombrada
      document.getElementById('formEditar').action = updateRouteTpl.replace(':id', id);

      // Rellenar campos
      document.getElementById('edit-id').value         = id;
      document.getElementById('edit-nombre').value     = btn.dataset.nombre || '';
      document.getElementById('edit-contacto').value   = btn.dataset.contacto || '';
      document.getElementById('edit-telefono').value   = btn.dataset.telefono || '';
      document.getElementById('edit-mail').value       = btn.dataset.mail || '';
      document.getElementById('edit-dir').value        = btn.dataset.dir || '';
    });
  });
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
  const destroyRouteTpl = @json(route('admin.suppliers.destroy', ['supplier' => ':id']));
  document.querySelectorAll('.deletebtn').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.id;
      document.getElementById('formEliminar').action = destroyRouteTpl.replace(':id', id);
      const hidden = document.getElementById('delete-id');
      if (hidden) hidden.value = id;
    });
  });
});
</script>



@endsection


