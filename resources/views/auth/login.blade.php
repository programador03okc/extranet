<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Edgar Alvarez Valdez">
    <title>Recursos Humanos</title>

    <link href="{{ asset('plugins/images/brand/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('plugins/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/icons.css') }}" rel="stylesheet">

</head>

<body class="app sidebar-mini ltr login-img">

    <div id="global-loader">
        <img src="{{ asset('plugins/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="">
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form action="{{ route('login') }}" method="POST" class="login100-form validate-form" style="width: 420px;">
                        @csrf
                        <span class="login100-form-title p-0">Módulo de Recursos Humanos</span>
                        <div class="text-center p-3">
                            <p class="text-dark mb-0">Gestión de permisos, vacaciones y horas extras</p>
                        </div>

                        <div class="panel panel-primary">
                            <div class="panel-body p-0 pt-5">
                                <div class="wrap-input100 validate-input input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                    </span>
                                    <input type="email" name="email" class="input100 border-start-0 form-control ms-0 @error('email') is-invalid @enderror" placeholder="Correo electrónico">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="wrap-input100 validate-input input-group">
                                    <span class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </span>
                                    <input type="password" name="password" class="input100 border-start-0 form-control ms-0 @error('password') is-invalid @enderror" placeholder="Contraseña">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary">Iniciar sesión</button>
                                </div>
                                <label class="login-social-icon"><span>V. 1.0</span></label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('plugins/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/js/show-password.min.js') }}"></script>
    <script src="{{ asset('plugins/js/generate-otp.js') }}"></script>
    <script src="{{ asset('plugins/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('plugins/js/themeColors.js') }}"></script>
    <script src="{{ asset('plugins/js/custom.js') }}"></script>
    @yield("scripts")
</body>
</html>