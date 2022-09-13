@extends('layout.plantilla')

@section('title', 'Nueva venta')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Realizar una venta</h3>
    
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
                                <label>Producto</label>
                                <select name="product_id" id="product_id" class="form-control select2" style="width: 100%;">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->nombre_prod }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cantidad</label>
                                <input type="number" class="form-control" id="cant_order_prod" name="cant_order_prod" placeholder="Cantidad de Producto" min="0">
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-md-2">
                            <button type="button" id="agregar_item" class="btn btn-block btn-success">Agregar</button>
                        </div>
                    </div>
                    <!-- /.row -->
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">Visit for more examples and information about the plugin.</div>


                <div class="card-body" id="items">
                    {{-- <div class="col-md-3">
                        <span></span>
                    </div> --}}
                </div>
                <!-- /.row -->


            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            let carrito = [];

            $("button").click(function() {
                const product = $('#product_id  option:selected');
                const cant_prod = $('#cant_order_prod').val();      
                crearItem(product, cant_prod);
            });  
            
            function crearItem(product, cant_prod) {
                const item = {
                    id: product.val(),
                    nombre: product.text(),
                    cantidad: cant_prod,
                }

                const busqueda = carrito.find((element) => element.id === item.id);
                if(!busqueda) {
                    carrito.push(item);
                    console.log(carrito);
                    crearElement(item);
                }
            }

            function crearElement(item) {
                let div = $("<div class='row'></div>");
                let elemento = '';
                elemento += "<div class='col-md-3'><p>"+item.id+"</p></div>";
                elemento += "<div class='col-md-3'><p>"+item.nombre+"</p></div>";
                elemento += "<div class='col-md-3'><p>"+item.cantidad+"</p></div>";
                elemento += "<div class='col-md-3'><buttom class='btn btn-danger'>Eliminar</buttom></div>";
                
                $(div).append(elemento);
                $('#items').append(div);
            }


        });
    </script>
@endpush






