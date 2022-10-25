@extends('layout.plantilla')

@section('title', 'Nuevo Proveedor')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Select2 (Default Theme)</h3>

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
                    <form action="{{ Route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ old('name', $user->name) }}">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                                <!-- /.form-group -->
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Usuario</label>
                                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" value="{{ old('user', $user->user) }}">
                                </div>
                                <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="password_confirmed" name="password_confirmed" placeholder="Repetir contraseña">
                                    <span id="password-ok" style="color: green; display:none;">* Las contraseñas coinciden.</span>
                                    <span id="password-error" style="color: red; display:none;">* Las contraseñas no coinciden.</span>
                                </div>
                                <!-- /.form-group -->
                            </div>

                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-block btn-success">Actualizar</button>
                            </div>
                        </div>
                        <!-- /.row -->
                
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                the plugin.
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#password_confirmed').on('keyup', function() {
            password = $('#password').val();
            if($(this).val() === password) {
                $('#password-ok').show();
                $('#password-error').hide();
            } else {
                $('#password-error').show();
                $('#password-ok').hide();
            }
        });
    </script>
@endpush