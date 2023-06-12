@extends('themes/app')

@section('titulo') Panel Principal @endsection

@section('links')
@endsection

@section('cabecera')
<div class="page-header">
    <h1 class="page-title">Panel principal</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Recursos humanos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Panel principal</li>
        </ol>
    </div>
</div>
@endsection

@section('contenido')
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="card-order">
                    <h2 class="text-end"><i class="icon-size mdi mdi-account-location float-start text-primary text-primary-shadow border-solid border-primary brround p-3"></i><span>{{ $totalPermisos }}</span></h2>
                    <p class="mb-0 pt-5">Total permisos<span class="float-end">{{ (($totalPermisos > 0) ? '100.00%' : '0.00%')}}</span></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="card-widget">
                    <h2 class="text-end"><i class="icon-size mdi mdi-eye float-start text-success text-warning-shadow border-solid border-success brround p-3"></i><span>{{ $totalPermisosAprobados }}</span></h2>
                    <p class="mb-0 pt-5">Total permisos aprobados<span class="float-end">{{ $porcentajePermisosAprobados }}%</span></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="card-widget">
                    <h2 class="text-end"><i class="icon-size mdi mdi-alert-outline float-start text-danger text-danger-shadow border-solid border-danger brround p-3"></i><span>{{ $totalPermisosPendientes }}</span></h2>
                    <p class="mb-0 pt-5">Total permisos pendientes<span class="float-end">{{ $porcentajePermisosPendientes }}%</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="card-order">
                    <h2 class="text-end"><i class="icon-size mdi mdi-account-box-outline float-start text-primary text-primary-shadow border-solid border-primary brround p-3"></i><span>{{ $totalLicencias }}</span></h2>
                    <p class="mb-0 pt-5">Total licencias<span class="float-end">{{ (($totalLicencias > 0) ? '100.00%' : '0.00%') }}</span></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="card-widget">
                    <h2 class="text-end"><i class="icon-size mdi mdi-account-check float-start text-success text-warning-shadow border-solid border-success brround p-3"></i><span>{{ $totalLicenciasAprobados }}</span></h2>
                    <p class="mb-0 pt-5">Total licencias aprobadas<span class="float-end">{{ $porcentajeLicenciasAprobados }}%</span></p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="card-widget">
                    <h2 class="text-end"><i class="icon-size mdi mdi-alert-octagram float-start text-danger text-danger-shadow border-solid border-danger brround p-3"></i><span>{{ $totalLicenciasPendientes }}</span></h2>
                    <p class="mb-0 pt-5">Total licencias pendientes<span class="float-end">{{ $porcentajeLicenciasPendientes }}%</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection
