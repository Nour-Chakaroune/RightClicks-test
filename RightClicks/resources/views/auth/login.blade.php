<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">

    <div class="login-box" style="width: 30%">

        <div class="card">
            <div class="card-body login-card-body">

                @if ($errors->any())
                    <div class="alert alert-danger fade show" role="alert" align="center">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="{{ route('login.custom') }}" method="post" autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                              <box-icon type='solid' name='user'></box-icon>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                              <box-icon name='lock-alt' type='solid' ></box-icon>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <span><b>Login as : </b></span> &nbsp; &nbsp; &nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" value="Admin" />Admin
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" value="User" />User
                        </div>

                    </div>


                    <div class="row">
                        <div class="col justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
