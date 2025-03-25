@extends('layouts.app')

@section('content')
<h1 class="mb-4">Listado de Productos</h1>

<a href="{{ route('products.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Nuevo Producto
</a>


<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table id="products-table" class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.data') }}",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category',
                    name: 'category.name'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });

        // Eliminar con SweetAlert2
        $(document).on('click', '.delete-btn', function() {
            const productId = $(this).data('id');
            const productName = $(this).data('name');

            Swal.fire({
                title: '¿Eliminar producto?',
                html: `¿Estás seguro de eliminar <strong>${productName}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/products/${productId}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            table.ajax.reload();
                            Swal.fire(
                                '¡Eliminado!',
                                'El producto ha sido eliminado.',
                                'success'
                            );
                        },
                        error: function() {
                            Swal.fire(
                                'Error',
                                'No se pudo eliminar el producto.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endsection