@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Editar un producto</h3>

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

                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Codigo</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo de Producto" value="{{ old('codigo', $product->codigo) }}" required>
                                </div>
                                <!-- /.form-group -->
        
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_prod" name="nombre_prod" placeholder="Nombre de Producto" value="{{ old('nombre_prod', $product->nombre_prod) }}" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                                        @foreach ($categories as $category)
                                            @if ($category->id == $product->category_id)
                                                <option value="{{ $category->id }}" selected>{{ $category->nombre_cat }}</option>
                                            @endif
                                            <option value="{{ $category->id }}">{{ $category->nombre_cat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Precio</label>
                                    <input type="number" class="form-control" id="precio_prod" name="precio_prod" placeholder="Precio de Producto" value="{{ old('precio_prod', $product->precio_prod) }}" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stock</label>
                                    <input type="number" class="form-control" id="stock_prod" name="stock_prod" placeholder="Cantidad" value="{{ old('stock_prod', $product->stock_prod) }}" required>
                                </div>
                                <!-- /.form-group -->
        
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Stock Minimo</label>
                                    <input type="number" class="form-control" id="stock_prod_min" name="stock_prod_min" value="{{ old('stock_prod_min', $product->stock_prod_min) }}" placeholder="Cantidad Minima" required>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.row -->
        
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" id="actualizar-producto" data-id="{{ $product->id }}" class="btn btn-block btn-success">Actualizar</button>
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

@push('scripts')
    <script>
        $('#actualizar-producto').on('click', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            token = "{{ csrf_token() }}";
            msg_error = $('#msg-error');
            msg_error.empty();

            data = {
                _method: 'PUT',
                _token: token,
                id: id,
                codigo: $('#codigo').val(),
                nombre_prod: $('#nombre_prod').val(),
                category_id: $('#category_id').val(),
                precio_prod: $('#precio_prod').val(),
                stock_prod: $('#stock_prod').val(),
                stock_prod_min: $('#stock_prod_min').val(),
            }

            $.ajax({
                type:"post",
                url:"/products/"+id,
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
                            title: 'Producto Actualizado'
                            })

                            $('.alert-danger').hide();
                            $('#form-porducts input').val('');
                    }
                },
                error: function(respuesta) {
                    const { responseJSON: { errors } } = respuesta;

                    if(errors) {
                        for(const e in errors) {
                        // console.log(errors[e]);
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