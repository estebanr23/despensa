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
                                        <option value="{{ $product->id }}" data-precio="{{ $product->precio_prod }}">{{ $product->nombre_prod }}</option>
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
                <div class="card-footer">Lista de productos seleccionados</div>


                {{-- <div class="card-body" id="items">

                </div> --}}
                <!-- /.row -->




                <div class="invoice p-3 mb-3">
                    <!-- Table row -->
                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                          <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                          </tr>
                          </thead>
                          <tbody id="items"></tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      
                    <div class="row">
                      <div class="col-6">
                        <p class="lead">Amount Due 2/22/2014</p>
      
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    <td id="total"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-12">
                        <button type="button" class="btn btn-danger float-right"><i class="fas fa-trash"></i> Cancelar</button>
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="far fa-credit-card"></i> Finalizar</button>
                      </div>
                    </div>
                </div>

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
                calcularTotal();
            });  
            
            function crearItem(product, cant_prod) {
                const precio = product.attr('data-precio')
                const item = {
                    id: product.val(),
                    nombre: product.text(),
                    cantidad: cant_prod,
                    precio: precio,
                    subTotal: (cant_prod * precio).toFixed(2),
                }
                

                const busqueda = carrito.find((element) => element.id === item.id);
                if(!busqueda) {
                    carrito.push(item);
                    console.log(carrito);
                    crearElement(item);
                }
            }

            function crearElement(item) {
                let fila = $("<tr></tr>");
                let elemento = '';
                elemento += "<td><p>"+item.nombre+"</p></td>";
                elemento += "<td><p>"+item.cantidad+"</p></td>";
                elemento += "<td><p>$ "+item.precio+"</p></td>";
                elemento += "<td><p>$ "+item.subTotal+"</p></td>";
                elemento += "<td><button id='"+item.id+"' class='btn hola btn-danger'>Eliminar</button></td>";

                
                $(fila).append(elemento);
                $('#items').append(fila);
            }

            function calcularTotal() {
                let total = carrito.reduce((acumulador, item) => acumulador + Number(item.subTotal), 0);
                $('#total').text(`$ ${total}`);
            }

        });


    </script>
@endpush





