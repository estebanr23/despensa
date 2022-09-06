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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="exampleInputEmail1">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña">
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Usuario</label>
                            <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                        </div>
                        <!-- /.form-group -->
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="password_confirmed" placeholder="Repetir contraseña">
                        </div>
                        <!-- /.form-group -->
                    </div>

                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-block btn-success">Success</button>
                    </div>
                </div>
                <!-- /.row -->
                
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