<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rrhh.permisos';
    protected $fillable = [
        'id_trabajador', 'id_grupo', 'id_division', 'id_autoriza', 'tipo_permiso_detalle_id', 'fecha', 'dias', 'horas', 'detalle', 'id_usuario', 
        'flag_sustento', 'sustento', 'aprobado', 'validado'
    ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
