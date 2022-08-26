@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Nuevo Pedido</h3>

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
                            <label>Proveedor</label>
                            <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Arcor</option>
                            <option>Arcor</option>
                            <option>Coca Cola</option>
                            <option>San Calletano</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cantidad</label>
                            <input type="number" class="form-control" id="cant_pedido" placeholder="Cantidad a solicitar">
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Producto</label>
                            <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Sandwich</option>
                            <option>Sandwich</option>
                            <option>Coca Cola</option>
                            <option>Fiambre</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Unidad</label>
                            <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Litro</option>
                            <option>Cm3</option>
                            <option>Kg</option>
                            <option>Unidad</option>
                            </select>
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title">Productos del Pedido</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                <th>Codigo</th>
                                <th>Proveedor</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td>Trident</td>
                                <td>Internet
                                    Explorer 4.0
                                </td>
                                <td>Win 95+</td>
                                <td> 4</td>
                                <td>X</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
    </section>
@endsection