@extends('layout.plantilla')

@section('title', 'Editar Categoria')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Editar un categoria</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <!-- Validacion -->
                    <div class="alert alert-danger" style="display: none">
                        <ul id="msg-error"></ul>
                    </div>

                    <form id="form-categories" action="#" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_cat" name="nombre_cat" placeholder="Nombre de Categoria" value="{{ old('nombre_cat' ,$category->nombre_cat) }}" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripcion</label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="5" placeholder="Descripcion de Categoria" required>{{ old('descripcion' ,$category->descripcion) }}</textarea>
                                </div>
                                <!-- /.form-group -->
                            </div>       
                        </div>
                        <!-- /.row -->
        
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" id="actualizar-categoria" data-id="{{ $category->id }}" class="btn btn-block btn-success">Actualizar</button>
                            </div>
                        </div>
                        <!-- /.row -->
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                Las categorias agregadas se podran visualizar en el listado de categorias.
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#actualizar-categoria').on('click', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            token = "{{ csrf_token() }}";
            msg_error = $('#msg-error');
            msg_error.empty();

            data = {
                _method: 'put',
                _token: token,
                nombre_cat: $('#nombre_cat').val(),
                descripcion: $('#descripcion').val(),
            }

            $.ajax({
                type:"post",
                url:"/categories/"+id,
                data: data,
                success: function(respuesta) {
                    if(respuesta === 'exito') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                            })

                            Toast.fire({
                            icon: 'success',
                            title: 'Categoria Actualizada'
                            })

                            $('.alert-danger').hide();
                    }
                },
                error: function(respuesta) {
                    const { responseJSON: { errors } } = respuesta;

                    if(errors) { // Mostrar errores de validacion
                        for(const e in errors) {
                        element = `<li>${errors[e]}</li>`;
                        msg_error.append(element);
                        }

                        $('.alert-danger').show();
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

        });
    </script>
@endpush