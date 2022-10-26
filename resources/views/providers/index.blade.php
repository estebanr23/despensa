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
                                    <a href="{{ Route('providers.edit', $provider->id) }}" title="Editar"><i class="fa fa-sharp fa-solid fa-marker"></i></a>
                                    {{-- <form class="form-icon" action="{{ Route('providers.destroy', $provider->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Eliminar" class="btn-icon"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    </form> --}}
                                    <button class="btn-icon eliminar-provedor" title="Eliminar" data-id="{{ $provider->id }}"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
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

@push('scripts')
    <script>
        // Eliminar provedor con todos sus items
        $('.eliminar-provedor').on('click', function(){
            id = $(this).attr('data-id');
            token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Desea eliminar?',
                text: "Una vez eliminado el proveedor no se podra recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {

                if (!result.isConfirmed) return;
                
                $.ajax({
                    type:'post',
                    url:"/providers/"+id,
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