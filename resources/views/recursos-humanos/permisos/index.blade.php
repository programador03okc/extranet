@extends('themes/app')

@section('titulo') Permisos @endsection

@section('links')
    <style>
        .select2-selection .select2-selection__clear {
            right: 10px;
        }
        div.dataTables_wrapper div.dataTables_filter input {
            margin-block-start: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        div.dataTables_wrapper div.dataTables_filter button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        table.table {
            width: 100%;
        }
        table.table tr th,
        table.table tr td {
            font-size: 11px;
        }
        table.table tr td {
            vertical-align: middle;
        }
        .icono-rrhh {
            font-size: 16px;
        }
        .table-inbox tr td i:hover {
            color: #fff;
        }
    </style>
@endsection

@section('cabecera')
<div class="page-header">
    <h1 class="page-title">Solicitud de Permisos</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Recursos humanos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permisos</li>
        </ol>
    </div>
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-2">
        <div id="scroll-stickybar" class="w-100" style="position: static; top: auto; left: 301.997px; width: 273.229px; margin-top: 0px;">
            <div class="card">
                <div class="card-body p-4 text-center">
                    <button class="btn btn-primary btn-block" id="nuevaSolicitud"><i class="fe fe-plus me-1"></i> Crear solicitud</button>
                </div>
                <div class="card-body pt-2">
                    <div class="list-group list-group-transparent mb-0 mail-inbox pb-3">
                        <a href="javascript:void(0)" class="list-group-item d-flex align-items-center">
                            <span class="icons"><i class="ri-mail-open-line"></i></span> Todos
                        </a>
                        <a href="javascript:void(0)" class="list-group-item d-flex align-items-center">
                            <span class="icons"><i class="ri-mail-send-line"></i></span> Pendiente
                        </a>
                        <a href="javascript:void(0)" class="list-group-item d-flex align-items-center">
                            <span class="icons"><i class="ri-star-line"></i></span> Aprobados
                        </a>
                        <a href="javascript:void(0)" class="list-group-item d-flex align-items-center">
                            <span class="icons"><i class="ri-delete-bin-line"></i></span> Rechazados
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de solicitudes de permisos</h3>
            </div>
            <div class="card-body p-3">
                <div class="inbox-body">
                    <div class="table-responsive">
                        <table class="table table-inbox mb-0" width="100%" id="tabla">
                            <thead class="table-primary">
                                <tr>
                                    <th>Solicitante</th>
                                    <th>Permiso</th>
                                    <th>Tipo Permiso</th>
                                    <th width="20">Días Horas</th>
                                    <th width="80">Responsable</th>
                                    <th width="30">Estado</th>
                                    <th width="30">Acción</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade effect-flip-vertical" id="modalRegistro">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formulario">
                @csrf
                <input type="hidden" name="id" class="form-control" value="0">
                <input type="hidden" name="flag_sustento" class="form-control" value="false">

                <div class="modal-header">
                    <h4 class="modal-title">Registrar nueva solicitud de permiso</h4>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Fecha:</label>
                                <input type="date" name="fecha" class="form-control text-center" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tipo de permiso:</label>
                                        <select name="tipo_permiso_id" class="form-control form-select select2 select-tipo-permiso" required>
                                            <option value=""></option>
                                            @foreach ($tpermisos as $tpermiso)
                                                <option value="{{ $tpermiso->id }}">{{ $tpermiso->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tipo de solicitud:</label>
                                        <select name="tipo_permiso_detalle_id" class="form-control form-select select2 select-detalle-permiso" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Grupo:</label>
                                <select name="grupo_id" class="form-control form-select select2 select-grupo" required>
                                    <option value=""></option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id_grupo }}">{{ $grupo->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Area:</label>
                                <select name="area_id" class="form-control form-select select2 select-area" required>
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Código cupón:</label>
                                <input type="text" name="cupon" class="form-control" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="form-label">Autorizado por:</label>
                                <select name="responsable_id" class="form-control form-select select2 select-responsable" required>
                                    <option value=""></option>
                                    @foreach ($responsables as $responsable)
                                        <option value="{{ $responsable->usuario->id_usuario }}">{{ $responsable->usuario->nombre_corto }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Días:</label>
                                        <input type="number" name="dias" class="form-control text-center" value="0" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Horas:</label>
                                        <input type="number" name="horas" class="form-control text-center" step="any" value="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Detallar permiso:</label>
                                <textarea name="detalle" class="form-control" placeholder="Escriba detalle del permiso" rows="4" style="resize: none;" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade effect-flip-vertical" id="modalAprobacion">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formulario-aprobacion">
                @csrf
                <input type="hidden" name="id_permiso" class="form-control" value="0">
                <input type="hidden" name="tipo_permiso" class="form-control" value="0">

                <div class="modal-header">
                    <h4 class="modal-title">Sustento de la aprobación</h4>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Sustentar aprobación:</label>
                                <textarea name="detalle" class="form-control" placeholder="Escriba el sustento de la aprobación" rows="4" style="resize: none;" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Aprobar</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade effect-flip-vertical" id="modalHistorial">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Historial de aprobación</h4>
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table">
                    <thead class="table-primary">
                        <tr>
                            <th>Fecha</th>
                            <th>Detalle de la acción</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody id="resultado-historial"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade effect-flip-vertical" id="modalSustento">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formulario-sustento" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_permiso" class="form-control" value="0">

                <div class="modal-header">
                    <h4 class="modal-title">Sustento del permiso</h4>
                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Archivo del sustento:</label>
                                <input type="file" name="archivo" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar sustento</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/select2/i18n/es.js') }}"></script>

    <script src="{{ asset('plugins/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('plugins/js/table-data.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".sidebar-mini").addClass("sidenav-toggled");
            listar();

            $('.select-area').select2({
                placeholder: "Elija un área",
                allowClear: true,
                language: "es",
                width: "100%"
            });

            $(".select-detalle-permiso").select2({
                placeholder: "Seleccione un tipo de solicitud",
                allowClear: true,
                language: "es",
                width: "100%"
            });

            $('.select-responsable').select2({
                placeholder: "Elija un responsable",
                allowClear: true,
                language: "es",
                width: "100%"
            });

            $('.select-tipo-permiso').select2({
                placeholder: "Elija un tipo de permiso",
                allowClear: true,
                language: "es",
                width: "100%"
            }).on("change", function (e) {
                let option = $(this).val();
                $.ajax({
                    type: "POST",
                    url: route('recursos-humanos.helpers.listar-detalle-permisos'),
                    data: {_token: csrf_token, valor: option},
                    dataType: "JSON",
                    success: function (response) {
                        cargarDetallePermisos(response);
                    }
                });
                return false;
            });

            $(".select-grupo").select2({
                placeholder: "Seleccione un grupo",
                allowClear: true,
                language: "es",
                width: "100%"
            }).on("change", function (e) {
                let option = $(this).val();
                $.ajax({
                    type: "POST",
                    url: route('recursos-humanos.helpers.listar-division'),
                    data: {_token: csrf_token, valor: option},
                    dataType: "JSON",
                    success: function (response) {
                        cargarDivisiones(response);
                    }
                });
                return false;
            });

            $("#nuevaSolicitud").on("click", function(e) {
                $("#formulario")[0].reset();
                $('[name=id]').val(0);
                $('[name=flag_sustento]').val(false);
                $(".select-detalle-permiso").empty();
                $(".select-area").empty();
                $(".select2").val(null).trigger('change');
                $("#modalRegistro").modal("show");
            });

            $("#formulario").on("submit", function(e) {
                $.ajax({
                    type: "POST",
                    url : route('recursos-humanos.guardar-permiso'),
                    data: $(this).serializeArray(),
                    dataType: "JSON",
                    success: function (response) {
                        Util.mensaje(response.alerta, response.mensaje);
                        if (response.respuesta == "ok") {
                            $('#tabla').DataTable().ajax.reload(null, false);
                            $("#modalRegistro").modal("hide");
                        }
                    }
                }).fail( function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
                return false;
            });

            $("#formulario-aprobacion").on("submit", function(e) {
                $.ajax({
                    type: "POST",
                    url : route('recursos-humanos.aprobar-permiso'),
                    data: $(this).serializeArray(),
                    dataType: "JSON",
                    success: function (response) {
                        Util.mensaje(response.alerta, response.mensaje);
                        if (response.respuesta == "ok") {
                            $('#tabla').DataTable().ajax.reload(null, false);
                            $("#modalAprobacion").modal("hide");
                        }
                    }
                }).fail( function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
                return false;
            });

            $("#formulario-sustento").on("submit", function(e) {
                $.ajax({
                    type: "POST",
                    url : route('recursos-humanos.guardar-sustento'),
                    data: new FormData($(this)[0]),
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function (response) {
                        Util.mensaje(response.alerta, response.mensaje);
                        if (response.respuesta == "ok") {
                            $('#tabla').DataTable().ajax.reload(null, false);
                            $("#modalSustento").modal("hide");
                        }
                    }
                }).fail( function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
                return false;
            });

            $("[name=tipo_permiso_detalle_id]").on("change", function(e) {
                let elemento = $(e.currentTarget);
                let seleccion = (elemento.find(':selected')[0]) ? elemento.find(':selected')[0].dataset.sustento : false;
                $("[name=flag_sustento]").val(seleccion);
            });

            $("#tabla").on("click", ".aprobar", function(e) {
                alert("aprobar?");
                e.preventDefault();
                let elemento = $(e.currentTarget);
                console.log(elemento.data("status"));

                if (elemento.data("status") == 1) {
                    alert("Ya está aprobado el permiso");
                } else {
                    alert("Ud no puede aprobar permisos");
                }
            })
        });

        function listar() {
            const $tabla = $('#tabla').DataTable({
                dom: 'frtip',
                pageLength: 20,
                destroy: true,
                language: idioma,
                serverSide: true,
                initComplete: function (settings, json) {
                    const $filter = $('#tabla_filter');
                    const $input = $filter.find('input');
                    $filter.append('<button id="btnBuscar" class="btn btn-primary pull-right" type="button"><i class="fe fe-search"></i></button>');
                    $input.off();
                    $input.on('keyup', (e) => {
                        if (e.key == 'Enter') {
                            $('#btnBuscar').trigger('click');
                        }
                    });
                    $('#btnBuscar').on('click', (e) => {
                        $tabla.search($input.val()).draw();
                    });
                },
                drawCallback: function (settings) {
                    $('#tabla_filter input').prop('disabled', false);
                    $('#btnBuscar').html('<i class="fe fe-search"></i>').prop('disabled', false);
                    $('#tabla_filter input').trigger('focus');
                },
                order: [[0, 'asc']],
                ajax: {
                    url: route('recursos-humanos.listar-permiso'),
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': csrf_token}
                },
                columns: [
                    {data: 'datos_solicitante'},
                    {data: 'permiso'},
                    {data: 'tipo_solicitud', className: 'text-center'},
                    {data: 'dia_hora', className: 'text-center'},
                    {data: 'datos_autoriza', className: 'text-center'},
                    {data: 'estado', orderable: false, searchable: false, className: 'text-center'},
                    {data: 'accion', orderable: false, searchable: false, className: 'text-center'}
                ]
            });
            $tabla.on('search.dt', function() {
                $('#tabla_filter input').attr('disabled', true);
                $('#btnBuscar').html('<i class="fe fe-stop-circle" aria-hidden="true"></i>').prop('disabled', true);
            });
            /*
            $tabla.on('init.dt', function(e, settings, processing) {
                $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
            });
            $tabla.on('processing.dt', function(e, settings, processing) {
                if (processing) {
                    $(e.currentTarget).LoadingOverlay('show', { imageAutoResize: true, progress: true, imageColor: '#3c8dbc' });
                } else {
                    $(e.currentTarget).LoadingOverlay("hide", true);
                }
            });
            */
        }

        function cargarDivisiones(data, id = 0) {
            let row = `<option></option>`;
            if (data.length > 0) {
                data.forEach(function(element, index) {
                    row  += `<option value="`+ element.id_division +`">`+ element.descripcion +`</option>`;
                });
            }
            $("[name=area_id]").html(row);
            $(".select-area").select2({
                placeholder: "Seleccione un área",
                allowClear: true,
                language: "es",
                width: "100%"
            });
        }

        function cargarDetallePermisos(data, id = 0) {
            let row = `<option></option>`;
            if (data.length > 0) {
                data.forEach(function(element, index) {
                    row  += `<option value="`+ element.id +`" data-sustento="`+ element.sustento +`">`+ element.descripcion +`</option>`;
                });
            }
            $("[name=tipo_permiso_detalle_id]").html(row);
            $(".select-detalle-permiso").select2({
                placeholder: "Seleccione un tipo de solicitud",
                allowClear: true,
                language: "es",
                width: "100%"
            });
        }

        function aprobar(id, tipo) {
            $("#formulario-aprobacion")[0].reset();
            $("[name=id_permiso]").val(id);
            $("[name=tipo_permiso]").val(tipo);
            $("#modalAprobacion").modal("show");
        }

        function historial(id) {
            let $lista = '';
            $.ajax({
                type: "POST",
                url : route('recursos-humanos.historial-permiso'),
                data: {_token: csrf_token, id: id},
                dataType: "JSON",
                success: function (response) {
                    if (response.length > 0) {
                        response.forEach(elemento => {
                            $lista += `<tr>
                                <td>`+ elemento.formato_fecha +`</td>
                                <td>`+ elemento.descripcion +`</td>
                                <td>`+ elemento.usuario.nombre_corto +`</td>
                            </tr>`
                        });
                    } else {
                        $lista += '<tr><td colspan="3">No se encontraron resultados</td></tr>';
                    }
                    $("#resultado-historial").html($lista);
                    $("#modalHistorial").modal("show");
                }
            }).fail( function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            });
            return false;
        }

        function sustento(id) {
            $("#formulario-sustento")[0].reset();
            $("[name=id_permiso]").val(id);
            $("#modalSustento").modal("show");
        }
    </script>
@endsection
