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

                                @if ($item->status_id == 1)
                                    <td><span style="padding: 5px 10px; background: rgb(243, 239, 16); color:#ffffff; border-radius:5px; font-weight:600">Pendiente</span></td>
                                @else
                                    <td><span style="padding: 5px 10px; background: rgb(61, 243, 16); color:#ffffff; border-radius:5px; font-weight:600">Recibido</span></td>
                                @endif
                                
                                <td>
                                    {{-- <form action="" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('delete') --}}
                                        <button type="submit" class="eliminar-item" data-item = "{{ $item->id }}" title="Eliminar" style="color:#007bff; background:none; border:none"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    {{-- </form> --}}
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
    </script>
@endpush