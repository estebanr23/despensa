@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Lista de Productos Eliminados</h3>
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
                                    {{-- <a href="{{ Route('products.restoreProduct', $product->id) }}"><i class="fa fa-solid fa-eye"></i></a> --}}
                                    <button class="btn-icon restaurar-producto" title="Eliminar" data-id="{{ $product->id }}"><i class="fa fa-solid fa-eye"></i></button>
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
        $('.restaurar-producto').on('click', function(){
            id = $(this).attr('data-id');
            token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Restaurar Producto?',
                text: "El producto estara disponible nuevamente en el stock.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {

                if (!result.isConfirmed) return;
                
                $.ajax({
                    type:'get',
                    url:"/products/restoreProduct/"+id,
                    success:function(respuesta) {
                        if(respuesta === 'exito') { 
                            Swal.fire(
                            'Correcto',
                            'Producto Restaurado',
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