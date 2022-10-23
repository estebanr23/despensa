@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Lista de Usuarios</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->user }}</td>
                                    <td>Roles</td>
                                    <td>
                                        <a href="" title="Editar"><i class="fa fa-sharp fa-solid fa-marker"></i></a>
                                        {{-- <form class="form-icon" action="{{ Route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" title="Eliminar" class="btn-icon"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                        </form> --}}
                                        <button class="eliminar-user btn-icon" data-id="{{ $user->id }}" title="Eliminar" class="btn-icon"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Rol</th>
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
        $('.eliminar-user').on('click', function() {
            id = $(this).attr('data-id');
            token = "{{ csrf_token() }}";

            Swal.fire({
                title: 'Desea eliminar?',
                text: "Una vez eliminado el usuario no se podra recuperar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {

                if (!result.isConfirmed) return;
                
                $.ajax({
                    type:'post',
                    url:'/users/'+id,
                    data: { _token: token, _method: 'delete' },
                    success:function(respuesta) {

                        if(respuesta === 'exito') { 
                            Swal.fire(
                            'Correcto',
                            'Usuario Eliminado',
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