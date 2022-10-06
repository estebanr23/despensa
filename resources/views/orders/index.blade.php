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
                <h3 class="card-title">Lista de Proveedores</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td>{{ $order->provider->nombre_prov }}</td>
                                <td>
                                    <a href="{{ Route('orders.edit', $order->id) }}" title="Editar"><i class="fa fa-sharp fa-solid fa-marker"></i></a>
                                    <form class="form-icon" action="{{ Route('orders.destroy', $order->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Eliminar" class="btn-icon"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    </form>
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