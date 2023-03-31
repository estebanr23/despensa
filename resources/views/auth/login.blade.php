<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DespensaApp - Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('admin/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  {{-- <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  {{-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('admin/css/adminlte.css') }}">

  <style>

    .login-box {
        display: flex;
        justify-content: center; 
        width: auto;
        height: 500px;
    }
    .login-box .card {
        width: 360px;
    }
    .image-form {
        width: 360px;
        background: url("{{ asset('images/cc_2.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .msg-error {
        color: red;
        margin: 5px 0;
        width: 100%;
        text-align: center;
    }

  </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Despensa</b>App</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg"><b>Iniciar Sesion</b></p>

            <form action="{{ Route('auth') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                <input type="text" class="form-control" name="user" placeholder="Usuario">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                </div>
                <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Recordarme
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="input-group"><span class="msg-error">{{ $errors->first('email') }}</span></div>
                <div class="input-group mb-3 mt-2">
                    <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1 text-center">
                Completar los datos para iniciar sesion.
            </p>
            {{-- <p class="mb-0">
                <a href="register.html" class="text-center">Register a new membership</a>
            </p> --}}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="image-form"></div>
    <!-- /.image-form -->

</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/js/adminlte.js') }}"></script>
</body>
</html>
