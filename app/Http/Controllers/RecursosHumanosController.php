<?php

namespace App\Http\Controllers;

use App\Models\Aprobador;
use App\Models\Grupo;
use App\Models\Permiso;
use App\Models\PermisoHistorial;
use App\Models\PermisosView;
use App\Models\TipoPermiso;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class RecursosHumanosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function permisos()
    {
        $grupos = Grupo::where('id_estado', '!=', 7)->orderBy('descripcion', 'asc')->get();
        $responsables = Aprobador::with(['usuario' => function($query) { 
            $query->select('id_usuario', 'nombre_corto')->orderBy('nombre_corto', 'asc');
        }])->get();
        $tpermisos = TipoPermiso::orderBy('descripcion', 'asc')->get();
        return view('recursos-humanos.permisos.index', get_defined_vars());
    }

    public function listarPermisos(Request $request)
    {
        $data = PermisosView::select(['*']);
        return DataTables::of($data)
        ->editColumn('fecha', function ($data) { return date('d/m/Y', strtotime($data->fecha)); })
        ->addColumn('dia_hora', function ($data) {
            $dia = ''; $hora = '';
            $txtDia = ''; $txtHora = '';
            if ($data->dias > 0) {
                $dia = ($data->dias > 1) ? ' (días)' : ' (día)';
                $txtDia = $data->dias.$dia;
            }
            if ($data->horas > 0) {
                $hora = ($data->horas > 1) ? ' (hrs)' : ' (hr)';
                $txtHora = $data->horas.$hora;
            }
            return $txtDia.'<br>'.$txtHora;
        })
        ->addColumn('estado', function ($data) {
            $estado = '';
            switch ($data->estado) {
                case 'ELABORADO':
                    $estado = '<i class="fa fa-file-text-o text-primary icono-rrhh"></i><br>'.$data->estado;
                break;
                case 'APROBADO':
                    $estado = '<i class="fa fa-star inbox-started icono-rrhh"></i><br>'.$data->estado;
                break;
                case 'VALIDADO':
                    $estado = '<i class="fa fa-bookmark text-danger icono-rrhh"></i><br>'.$data->estado;
                break;
                case 'FINALIZADO':
                    $estado = '<i class="fa fa-check text-success icono-rrhh"></i><br>'.$data->estado;
                break;
            }
            return $estado;
        })
        ->addColumn('accion', function ($data) {
            $opcion = '<li><a href="javascript:void(0)" onclick="historial('.$data->id.')">Ver historial</a></li>';
            if ($data->check_validado == 'NO') {
                if ($data->check_aprobado == 'NO') {
                    if ($data->id_autoriza == Auth::user()->id_usuario) {
                        $opcion .= '<li><a href="javascript:void(0)" onclick="aprobar('.$data->id.', 1);">Aprobar</a></li>';
                    }
                } else {
                    if (Auth::user()->id_usuario == 2 || Auth::user()->id_usuario == 1 || Auth::user()->id_usuario == 127 || Auth::user()->id_usuario == 148) {
                        $opcion .= '<li><a href="javascript:void(0)" onclick="aprobar('.$data->id.', 2);">Validar</a></li>';
                    }
                }
            } else {
                if ($data->id_usuario == Auth::user()->id_usuario) {
                    $opcion .= '<li><a href="javascript:void(0)" onclick="sustento('.$data->id.');">Agregar sustento</a></li>';
                }
            }
            return '<div class="btn-group mt-2 mb-2">
                <button type="button" class="btn btn-primary btn-sm btn-pill dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fe fe-settings"></i> <span class="caret"></span>
                    </button>
                <ul class="dropdown-menu" role="menu" style="">
                    '.$opcion.'
                </ul>
            </div>';
        })
        ->rawColumns(['dia_hora', 'accion', 'estado'])->make(true);
    }

    public function guardarPermiso(Request $request)
    {
        
        DB::beginTransaction();
        try {
            $data = Permiso::firstOrNew(['id' => $request->id]);
                $data->id_trabajador = Auth::user()->id_trabajador;
                $data->id_grupo = $request->grupo_id;
                $data->id_division = $request->area_id;
                $data->tipo_permiso_detalle_id = $request->tipo_permiso_detalle_id;
                $data->flag_sustento = $request->flag_sustento;
                $data->id_autoriza = $request->responsable_id;
                $data->fecha = $request->fecha;
                $data->dias = $request->dias;
                $data->horas = $request->horas;
                $data->detalle = Str::upper($request->detalle);
                $data->cupon = $request->cupon;
                $data->id_usuario = Auth::user()->id_usuario;
            $data->save();

            $historial = new PermisoHistorial();
                $historial->id_permiso = $data->id;
                $historial->id_usuario = Auth::user()->id_usuario;
                $historial->descripcion = 'CREACIÓN DE LA SOLICITUD DE PERMISO';
            $historial->save();
    
            DB::commit();
            $respuesta = 'ok';
            $alerta = 'success';
            $mensaje = ($request->id > 0) ? 'Se ha editado el permiso' : 'Se ha registrado el permiso';
            $error = '';
        } catch (Exception $ex) {
            DB::rollBack();
            $respuesta = 'error';
            $alerta = 'error';
            $mensaje = 'Hubo un problema al registrar. Por favor intente de nuevo';
            $error = $ex;
        }
        return response()->json(array('respuesta' => $respuesta, 'alerta' => $alerta, 'mensaje' => $mensaje, 'error' => $error), 200);
    }

    public function aprobarPermiso(Request $request)
    {
        DB::beginTransaction();
        try {
            $permiso = Permiso::find($request->id_permiso);
                if ($request->tipo_permiso == 1) {
                    $permiso->aprobado = true;
                }
                if ($request->tipo_permiso == 2) {
                    $permiso->validado = true;
                }
            $permiso->save();

            $historial = new PermisoHistorial();
                $historial->id_permiso = $request->id_permiso;
                $historial->id_usuario = Auth::user()->id_usuario;
                $historial->descripcion = Str::upper($request->detalle);
            $historial->save();
    
            DB::commit();
            $respuesta = 'ok';
            $alerta = 'success';
            $mensaje = ($request->tipo_permiso == 1) ? 'Se aprobó el permiso' : 'La jefatura de RRHH validó la solicitud';
            $error = '';
        } catch (Exception $ex) {
            DB::rollBack();
            $respuesta = 'error';
            $alerta = 'error';
            $mensaje = 'Hubo un problema al registrar. Por favor intente de nuevo';
            $error = $ex;
        }
        return response()->json(array('respuesta' => $respuesta, 'alerta' => $alerta, 'mensaje' => $mensaje, 'error' => $error), 200);
    }

    public function guardarSustento(Request $request)
    {
        
        DB::beginTransaction();
        try {
            $data = Permiso::find($request->id_permiso);
            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $file_name = uniqid().'-'.time().'.'.$file->getClientOriginalExtension();
                $file_path = public_path().'/documentos/permisos/sustentos/'.$file_name;
                $file->move(public_path().'/documentos/permisos/sustentos/', $file_name);
                $data->sustento = $file_path;
            }
            $data->save();

            $historial = new PermisoHistorial();
                $historial->id_permiso = $data->id;
                $historial->id_usuario = Auth::user()->id_usuario;
                $historial->descripcion = 'SUSTENTO DEL PERMISO POSTERIOR A LA EJECUCIÓN DEL MISMO';
            $historial->save();
    
            DB::commit();
            $respuesta = 'ok';
            $alerta = 'success';
            $mensaje = 'Se ha registrado el sustento del permiso';
            $error = '';
        } catch (Exception $ex) {
            DB::rollBack();
            $respuesta = 'error';
            $alerta = 'error';
            $mensaje = 'Hubo un problema al registrar. Por favor intente de nuevo';
            $error = $ex;
        }
        return response()->json(array('respuesta' => $respuesta, 'alerta' => $alerta, 'mensaje' => $mensaje, 'error' => $error), 200);
    }

    public function historialPermiso(Request $request)
    {
        $data = PermisoHistorial::with('usuario')->where('id_permiso', $request->id)->orderBy('created_at', 'asc')->get();
        return response()->json($data);
    }
}
