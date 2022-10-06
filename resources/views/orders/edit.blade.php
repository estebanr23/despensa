@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Productos de Pedido</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->product->nombre_prod }}</td>
                                <td>{{ $item->cant_order_prod }}</td>

                                {{-- @if ($item->status_id == 1) --}}
                                @if ($item->status->nombre_status == 'Pendiente')
                                    <td><span class="order-pendiente">Pendiente</span></td>
                                @else
                                    <td><span class="order-recibido">Recibido</span></td>
                                @endif
                                
                                <td>
                                    @if ($item->status_id == 1)
                                        <button type="submit" class="estado-item" data-item = "{{ $item->id }}" title="Cambiar estado" style="color:#007bff; background:none; border:none"><i class="fa fa-sharp fa-solid fa-check"></i></button>
                                    @endif
                                    <button type="submit" class="eliminar-item" data-item = "{{ $item->id }}" title="Eliminar" style="color:#007bff; background:none; border:none"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Pedido</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
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
        // Eliminar item de pedido
        $('.eliminar-item').on('click', function(e) {
            e.preventDefault();

            const fila = $(this.closest('tr')).remove();
            const id = $(this).attr('data-item');
            token = "{{csrf_token()}}";

            $.ajax({
                type: 'delete',
                url: '/orders/destroyItem/'+id,
                data: {_token:token},
                success: function(respuesta) {
                    if(respuesta === 'exito') {
                        fila.remove();
                        console.log(respuesta); // eliminar clg
                    }        
                }
            });
        });

        // Cambiar estado de un item de pedido
        $('.estado-item').on('click', function() {
            id = $(this).attr('data-item');

            $.ajax({
                type: 'get',
                url: '/orders/cambiarEstado/'+id,
                success: function(respuesta) {

                    // *** Hacer que cambie el estado dinamicamente. Agregar y quitar clase al span *** 
                    console.log(respuesta);
                }
            });
        });
    </script>
@endpush