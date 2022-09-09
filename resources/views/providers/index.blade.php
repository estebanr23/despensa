@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
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
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($providers as $provider)
                            <tr>
                                <td>{{ $provider->nombre_prov }}</td>
                                <td>{{ $provider->direccion_prov }}</td>
                                <td>{{ $provider->email_prov }}</td>
                                <td>{{ $provider->telefono_prov }}</td>
                                <td>
                                    <a href="#"><i class="fa fa-solid fa-eye"></i></a>
                                    <a href="{{ Route('providers.edit', $provider->id) }}" title="Editar"><i class="fa fa-sharp fa-solid fa-marker"></i></a>
                                    <a href="#"><i class="fa fa-sharp fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach  
                    <tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Email</th>
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