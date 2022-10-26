@extends('layout.plantilla')

@section('title', 'Nuevo Proveedor')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Agregar Provedor</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Errores -->
                @if ($errors->any())
                    <div class="alert alert-danger" style="padding-bottom: 0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ Route('providers.update', $provider) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_prov" name="nombre_prov" placeholder="Nombre de Proveedor" value="{{ old('nombre_prov', $provider->nombre_prov) }}">
                                </div>
                                <!-- /.form-group -->
        
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="email_prov" name="email_prov" placeholder="Email" value="{{ old('email_prov', $provider->email_prov) }}">
                                </div>
                                <!-- /.form-group -->
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Direccion</label>
                                    <input type="text" class="form-control" id="direccion_prov" name="direccion_prov" placeholder="Direccion" value="{{ old('direccion_prov', $provider->direccion_prov) }}">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefono</label>
                                    <input type="tel" class="form-control" id="telefono_prov" name="telefono_prov" placeholder="Telefono" value="{{ old('telefono_prov', $provider->telefono_prov) }}">
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
                    Los provedores agregados se podran visualizar en el listado de provedores.
                </div>
            </div>
        </div>
    </section>
@endsection