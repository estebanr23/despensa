@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Lista de Productos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->codigo }}</td>
                                <td>{{ $product->nombre_prod }}</td>
                                <td>{{ $product->category->nombre_cat }}</td>
                                <td>{{ $product->precio_prod }}</td>
                                <td>{{ $product->stock_prod }}</td>
                                <td>
                                    <a href="{{ Route('products.edit', $product->id) }}" title="Editar"><i class="fa fa-sharp fa-solid fa-marker"></i></a>
                                    {{-- <form class="form-icon" action="{{ Route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Eliminar" class="btn-icon"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    </form> --}}
                                    @can('eliminar productos')
                                        <button class="btn-icon eliminar-producto" title="Eliminar" data-id="{{ $product->id }}"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script>
        // Eliminar provedor con todos sus items
        $('.eliminar-producto').on('click', function(){
            id = $(this).attr('data-id');
            token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Desea eliminar?',
                text: "Una vez eliminada el pedido no se podra recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {

                if (!result.isConfirmed) return;
                
                $.ajax({
                    type:'post',
                    url:"/products/"+id,
                    data: { _token: token, _method: 'delete' },
                    success:function(respuesta) {

                        if(respuesta === 'exito') { 
                            Swal.fire(
                            'Correcto',
                            'Proveedor Eliminado',
                            'success'
                            )
                        } else {
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!',
                            footer: '<p>Comuniquese con el administrador.</p>'
                            })
                        } 
                    }

                });
            })
        });
    </script>
@endpush