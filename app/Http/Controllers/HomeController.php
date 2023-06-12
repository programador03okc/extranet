<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\PermisosView;
use App\Models\TipoSolicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalPermisos = PermisosView::where('tipo_permiso', 'Permiso')->where('id_usuario', Auth::user()->id_usuario)->count();
        $totalPermisosAprobados = PermisosView::where('tipo_permiso', 'Permiso')->where('check_aprobado', 'SI')->where('id_usuario', Auth::user()->id_usuario)->count();
        $totalPermisosPendientes = PermisosView::where('tipo_permiso', 'Permiso')->where('check_aprobado', 'NO')->where('id_usuario', Auth::user()->id_usuario)->count();
        $totalLicencias = PermisosView::where('tipo_permiso', 'Licencia')->where('id_usuario', Auth::user()->id_usuario)->count();
        $totalLicenciasAprobados = PermisosView::where('tipo_permiso', 'Licencia')->where('check_aprobado', 'SI')->where('id_usuario', Auth::user()->id_usuario)->count();
        $totalLicenciasPendientes = PermisosView::where('tipo_permiso', 'Licencia')->where('check_aprobado', 'NO')->where('id_usuario', Auth::user()->id_usuario)->count();

        $porcentajePermisosAprobados = ($totalPermisos > 0) ? number_format((($totalPermisosAprobados * 100) / $totalPermisos), 2) : number_format(0, 2);
        $porcentajePermisosPendientes = ($totalPermisos > 0) ? number_format((($totalPermisosPendientes * 100) / $totalPermisos), 2) : number_format(0, 2);
        $porcentajeLicenciasAprobados = ($totalLicencias > 0) ? number_format((($totalLicenciasAprobados * 100) / $totalLicencias), 2) : number_format(0, 2);
        $porcentajeLicenciasPendientes = ($totalLicencias > 0) ? number_format((($totalLicenciasPendientes * 100) / $totalLicencias), 2) : number_format(0, 2);
        return view('inicio', get_defined_vars());
    }

    public function listarDivision(Request $request)
    {
        $data = Division::where('grupo_id', $request->valor)->get();
        return response()->json($data, 200);
    }

    public function listarDetallePermiso(Request $request)
    {
        $data = TipoSolicitud::where('tipo_permiso_id', $request->valor)->get();
        return response()->json($data, 200);
    }
}
