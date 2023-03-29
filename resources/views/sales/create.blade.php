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
                                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo de Producto" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="check-fiado">
                                <label class="form-check-label" for="check-fiado">Crear Fiado</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row" id="datos_cliente" style="display: none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cliente</label>
                                <select name="cliente_id" id="cliente_id" class="form-control select2" style="width: 100%;">
                                    <option value="" disabled selected>Seleccionar</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nombre_cliente }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="cliente">Nuevo Cliente</label>
                                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre de Cliente">
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">Lista de productos seleccionados</div>

                <div class="invoice p-3 mb-3">
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <p class="lead">Fecha {{ date('d/m/Y') }}</p>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
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
                      <div class="col-5">
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
                        <a href="{{ Route('sales.create') }}" class="btn btn-danger float-right"><i class="fas fa-trash"></i> Cancelar</a>
                        <button type="button" id="fin_venta" class="btn btn-primary float-right" style="margin-right: 5px;"><i class="far fa-credit-card"></i> Finalizar</button>
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
            let total=0;
            let credito;
            let cant_carrito = 0;

            $('#codigo').on('keyup', function() {
                codigo = $(this).val();

                if (codigo.length === 13) {
                    $.ajax({
                        type: 'get',
                        url:`/products/${codigo}`,
                        success:function(resultado) {
                            if(resultado) {
                                crearItem(resultado); // Envia por parametros el producto obtenido
                                calcularTotal();
                            }
                        },
                        error:function(resultado) {
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!',
                            footer: '<p>No se pudo encontrar el producto.</p>'
                            })
                        }
                    });
                }
            });

            function crearItem(product) {
                const item = {
                    ui_id: ++cant_carrito,
                    product_id: product.id,
                    nombre: product.nombre_prod,
                    cant_sale_prod: 1,
                    total_item: product.precio_prod.toFixed(2),
                }
                
                carrito.push(item);
                crearElement(item);
            }

            function crearElement(item) {
                let fila = $("<tr></tr>");
                let elemento = '';
                elemento += "<td><p>"+item.nombre+"</p></td>";
                elemento += "<td><p>"+item.cant_sale_prod+"</p></td>";
                elemento += "<td><p>$ "+item.total_item+"</p></td>";
                elemento += "<td><button data-id='"+item.ui_id+"' class='btn btn-danger delete'>Eliminar</button></td>";

                
                $(fila).append(elemento);
                $('#items').append(fila);
            }

            function calcularTotal() {
                total = carrito.reduce((acumulador, item) => acumulador + Number(item.total_item), 0).toFixed(2);
                $('#total').text(`$ ${total}`);
            }

            // Guardar datos
            $('#fin_venta').on('click', function() {
                $(this).prop('disabled', true);

                credito = $('input[type=checkbox]:checked').val();
                let token = "{{ csrf_token() }}";
                let cliente;

                if(credito) {
                    cliente = $('#cliente_id option:selected').val();
                    if(!cliente) {
                        cliente = $('#nombre_cliente').val();
                    }
                }

                $.ajax({
                    type: "post",
                    data: {carrito: carrito, credito: credito, total_sale: total, cliente: cliente, _token: token},
                    url:"{{ Route('sales.store') }}",
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
                                title: 'Venta Exitosa'
                                })
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

                $(this).prop('disabled', false);
                
            });

            // Eliminar item generado dinamicamente
            $('body').on('click', '.delete' ,function() {
                const id = parseInt($(this).attr('data-id'));
                const padre = $(this).closest('tr');
                carrito = carrito.filter((element) => element.ui_id !== id);
                calcularTotal();
                padre.remove();
            });

            // Checkbox
            $('#check-fiado').change(function () {
                let check = $('#check-fiado')[0].checked;

                if(check) {
                    $('#datos_cliente').show();
                } else {
                    $('#datos_cliente').hide();
                }
            });

        });


    </script>
@endpush





