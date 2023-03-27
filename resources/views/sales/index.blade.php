@extends('layout.plantilla')

@section('title', 'Listado de Ventas')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="modal-venta" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ol class="list-group list-group-numbered" id="items-venta"></ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Lista de Ventas Realizadas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Total</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ date('d-m-Y', strtotime($sale->created_at)) }}</td>
                                <td>{{ date('H:m', strtotime($sale->created_at)) }} hs</td>
                                <td>$ {{ $sale->total_sale }}</td>
                                <td>{{ $sale->user->name }}</td>
                                <td>
                                    {{-- <a href="{{ Route('sales.show', $sale) }}" title="Ver" id="show-modal"><i class="fa fa-solid fa-eye"></i></a> --}}
                                    <a id="{{ $sale->id }}" class="openBtn"><i class="fa fa-solid fa-eye"></i></a>
                                    {{-- <a href="#"><i class="fa fa-sharp fa-solid fa-trash"></i></a> --}}
                                    {{-- <form class="form-icon" action="{{ Route('sales.destroy', $sale->id) }}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Eliminar" class="btn-icon"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    </form> --}}
                                    <button class="btn-icon eliminar-venta" title="Eliminar" data-id="{{ $sale->id }}"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Total</th>
                            <th>Usuario</th>
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
        // Mostar items de venta
        $('.openBtn').on('click' ,function(e) {
            e.preventDefault();
            $('#items-venta').empty();
            id = $(this).attr('id');

            $.ajax({
                type:"get",
                url:"/sales/"+id,
                success: function(items) {
                    if(items) {
                        items.forEach(item => {
                            let fila = $("<li class='list-group-item d-flex justify-content-between align-items-start'></li>");
                            let elemento = "<div class='ms-2 me-auto'><div class='fw-bold'>"+item.nombre_prod+"</div>$ "+item.precio_prod+"</div>";
                            elemento += "<span class='badge bg-primary rounded-pill'>"+item.cant_sale_prod+"</span>";

                            $(fila).append(elemento);
                            $('#items-venta').append(fila);
                        });
                        $('#modal-venta').modal("show");
                    }
                }
            });
        });

        // Eliminar venta con todos sus items
        $('.eliminar-venta').on('click', function(){
            id = $(this).attr('data-id');
            token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Desea eliminar?',
                text: "Una vez eliminada la venta no se podra recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {

                if (!result.isConfirmed) return;
                
                $.ajax({
                    type:'post',
                    url:"/sales/"+id,
                    data: { _token: token, _method: 'delete' },
                    success:function(respuesta) {

                        if(respuesta === 'exito') { 
                            Swal.fire(
                            'Correcto',
                            'Venta Eliminada',
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
                    },
                    error:function(respuesta) {
                        console.log(respuesta)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!',
                            footer: '<p>Comuniquese con el administrador.</p>'
                        })
                    }

                });

            })

        });

    </script>
@endpush