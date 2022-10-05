@extends('layout.plantilla')

@section('title', 'Nuevo Producto')
    
@section('content')
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Lista de Categorias</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $categorie)
                            <tr>
                                <td>{{ $categorie->id }}</td>
                                <td>{{ $categorie->nombre_cat }}</td>
                                <td>{{ $categorie->descripcion }}</td>
                                <td>
                                    <a href="{{ Route('categories.edit', $categorie->id) }}" title="Editar"><i class="fa fa-sharp fa-solid fa-marker"></i></a>
                                    <form action="{{ Route('categories.destroy', $categorie->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Eliminar" style="color:#007bff; background:none; border:none"><i class="fa fa-sharp fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection