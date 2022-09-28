@extends('layout.plantilla')

@section('title', 'Listado Ventas')

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
                            <th>Fecha y Hora</th>
                            <th>Total</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->created_at }}</td>
                                <td>$ {{ $sale->total_sale }}</td>
                                <td>{{ $sale->user->name }}</td>
                                <td>
                                    {{-- <a href="{{ Route('sales.show', $sale) }}" title="Ver" id="show-modal"><i class="fa fa-solid fa-eye"></i></a> --}}
                                    <a id="{{ $sale->id }}" class="openBtn"><i class="fa fa-solid fa-eye"></i></a>
                                    <a href="#"><i class="fa fa-sharp fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Codigo</th>
                            <th>Fecha y Hora</th>
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
                            let elemento = "<div class='ms-2 me-auto'><div class='fw-bold'>"+item.nombre_prod+"</div>"+item.precio_prod+"</div>";
                            elemento += "<span class='badge bg-primary rounded-pill'>"+item.cant_sale_prod+"</span>";

                            $(fila).append(elemento);
                            $('#items-venta').append(fila);
                        });
                        $('#modal-venta').modal("show");
                    }
                }
            });

        });

    </script>
@endpush