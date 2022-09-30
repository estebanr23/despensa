@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Agregar un pedido</h3>

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
                                    <select class="form-control select2" id="provider_id" name="provider_id" style="width: 100%;">
                                        @foreach ($providers as $provider)
                                            <option value="{{ $provider->id }}">{{ $provider->nombre_prov }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="form-control select2" id="product_id" name="product_id" style="width: 100%;">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->nombre_prod }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cantidad</label>
                                    <input type="number" class="form-control" id="cant_order_prod" name="cant_order_prod" placeholder="Cantidad de Producto" min="0" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->
        
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" id="agregar_item" class="btn btn-block btn-success">Guardar</button>
                            </div>
                        </div>
                        <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">Los pedidos agregados se podran visualizar en el listado de pedidos.</div>
                <div class="invoice p-3 mb-3">
                    <!-- Table row -->
                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                          <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                          </tr>
                          </thead>
                          <tbody id="items"></tbody>
                        </table>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
      
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                      <div class="col-12">
                        <button type="button" class="btn btn-danger float-right"><i class="fas fa-trash"></i> Cancelar</button>
                        <button type="button" id="fin_pedido" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="far fa-credit-card"></i> Finalizar</button>
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
            let provider;

            $("#agregar_item").click(function(event) {
                const product = $('#product_id  option:selected');
                provider = $('#provider_id  option:selected').val();
                $('#provider_id').attr('disabled', 'true');
                const cant_prod = $('#cant_order_prod').val();   
                crearItem(product, cant_prod);
            });  
            
            function crearItem(product, cant_prod) {
                const item = {
                    product_id: product.val(),
                    product: product.text(),
                    cant_order_prod: cant_prod,
                }
                

                const busqueda = carrito.find((element) => element.id === item.product_id);
                if(!busqueda) {
                    carrito.push(item);
                    console.log(carrito);
                    crearElement(item);
                }
            }

            function crearElement(item) {
                let fila = $("<tr></tr>");
                let elemento = '';
                elemento += "<td><p>"+item.product+"</p></td>";
                elemento += "<td><p>"+item.cant_order_prod+"</p></td>";
                elemento += "<td><button id='"+item.product_id+"' class='btn hola btn-danger'>Eliminar</button></td>";

                
                $(fila).append(elemento);
                $('#items').append(fila);
            }

            // Guardar datos
            $('#fin_pedido').on('click', function() {
                let token = "{{ csrf_token() }}";
                $.ajax({
                    type: "post",
                    data: {carrito: carrito, provider: provider, _token: token},
                    url:"{{ Route('orders.store') }}",
                    success: function(respuesta) {
                        // *** Agregar mensaje de exito ***
                        console.log(respuesta);
                    }
                });
            });

        });
    </script>
@endpush