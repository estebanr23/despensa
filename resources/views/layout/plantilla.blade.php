<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
  <!-- DataTables -->
  <link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-bs4/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-responsive/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('admin/plugins/datatables-buttons/buttons.bootstrap4.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.css') }}">
  <!-- Main style -->
  <link rel="stylesheet" href="{{ asset('admin/css/main.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('admin/img/coca-cola.gif')}}" alt="Imagen de carga" height="250" width="250">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ Route('dashboard') }}" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link cerrar-sesion" href="{{ Route('logout') }}" role="button">
          Cerrar Sesion
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ Route('dashboard') }}" class="brand-link">
      <img src="{{ asset('admin/img/DespensaLogo.png') }} " alt="Despensa Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Despensa App</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex div-user">
        <i class="nav-icon fas fa-user"></i>
        <div class="info">
          <p href="#" class="d-block mb-0">{{ auth()->user()->name }}</p>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar form-search-edit" style="color:black;" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
            <!-- *** Agregar items de menu aqui *** -->
            <!-- Ventas -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-money-check-alt"></i>
                <p>
                  Ventas
                  <i class="fas fa-chevron-circle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ Route('sales.create') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Agregar Venta</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('sales.index') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Ventas Realizadas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('sales.credits') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Fiados Realizados</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Categorias -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th-list"></i>
                <p>
                  Categorias
                  <i class="fas fa-chevron-circle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ Route('categories.create') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Agregar Categorias</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('categories.index') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Lista de Categorias</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Productos -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                  Productos
                  <i class="fas fa-chevron-circle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ Route('products.create') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Agregar Producto</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('products.index') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Lista de Productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('products.listDelete') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Productos Eliminados</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Pedidos -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-truck"></i>
                <p>
                  Pedidos
                  <i class="fas fa-chevron-circle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ Route('orders.create') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Agregar Pedido</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('orders.index') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Lista de Pedidos</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Proveedores -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Proveedores
                  <i class="fas fa-chevron-circle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ Route('providers.create') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Agregar Proveedor</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ Route('providers.index') }}" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Lista de Proveedores</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Usuarios -->
            @role('Administrador')
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Usuarios
                    <i class="fas fa-chevron-circle-down right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ Route('users.create') }}" class="nav-link">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Agregar Usuario</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ Route('users.index') }}" class="nav-link">
                      <i class="fas fa-angle-right nav-icon"></i>
                      <p>Lista de Usuarios</p>
                    </a>
                  </li>
                </ul>
              </li>
            @endrole

            <!-- Roles -->
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tools"></i>
                <p>
                  Roles
                  <i class="fas fa-chevron-circle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Agregar Rol</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-angle-right nav-icon"></i>
                    <p>Lista de Roles</p>
                  </a>
                </li>
              </ul>
            </li> --}}

            <!-- Informes -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ Route('dashboard') }}">Inicio</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- *** Agregar contenido aqui *** -->
        @yield('content')
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} DespensaApp.</strong>
    Todos los derechos reservados
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('admin/plugins/bootstrap/bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('admin/js/adminlte.js') }}"></script>

<!-- SweetAlert2 -->
<script src="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Select2 -->
<script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>
<script>
    $(function() {

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
    theme: 'bootstrap4'
    })

    });
</script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/buttons.colVis.min.js') }}"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@stack('scripts')
</body>
</html>
