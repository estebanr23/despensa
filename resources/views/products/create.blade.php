@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Agregar un producto</h3>

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
                    <form action="{{ Route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Codigo</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo de Producto" required>
                                </div>
                                <!-- /.form-group -->
        
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_producto" name="nombre_prod" placeholder="Nombre de Producto" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->nombre_cat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Precio</label>
                                    <input type="number" class="form-control" id="precio_prod" name="precio_prod" placeholder="Precio de Producto" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stock</label>
                                    <input type="number" class="form-control" id="stock_prod" name="stock_prod" placeholder="Cantidad" required>
                                </div>
                                <!-- /.form-group -->
        
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stock Minimo</label>
                                    <input type="number" class="form-control" id="stock_prod_min" name="stock_prod_min" placeholder="Cantidad Minima" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->
        
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-block btn-success">Guardar</button>
                            </div>
                        </div>
                        <!-- /.row -->
                    </form>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                Los productos agregados se podran visualizar en el listado de productos.
                </div>
            </div>
        </div>
    </section>
@endsection