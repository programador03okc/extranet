<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Edgar Alvarez Valdez">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('plugins/images/brand/favicon.ico') }}">
    <title>RRHH - @yield('titulo')</title>
    
    <link id="style" href="{{ asset('plugins/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/plugins/lobibox/dist/css/lobibox.min.css') }}" rel="stylesheet">
    @yield("links")
</head>

<body class="app sidebar-mini ltr light-mode">

    <div id="global-loader">
        <img src="{{ asset('plugins/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="page-main">
            <div class="app-header header sticky">
                @include("themes/header")
            </div>
            <div class="sticky" style="margin-bottom: -73.9931px;">
                @include("themes/aside")
            </div>
            <div class="main-content app-content mt-0">
                <div class="side-app">
                    <div class="main-container container-fluid">
                        @yield("cabecera")
                        @yield("contenido")
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">Copyright © <span></span> OKC COMPUTER</div>
                </div>
            </div>
        </footer>
    </div>
    
    <script src="{{ asset('plugins/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('plugins/plugins/sidemenu/sidemenu.js') }}"></script>
    <script src="{{ asset('plugins/js/themeColors.js') }}"></script>
    <script src="{{ asset('plugins/js/sticky.js') }}"></script>
    <script src="{{ asset('plugins/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/plugins/lobibox/dist/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('plugins/js/util.js') }}"></script>
    <script>
        const csrf_token = '{{ csrf_token() }}';

        const idioma = {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate":
            {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria":
            {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        };
    </script>
    @routes
    @yield("scripts")
</body>
</html>