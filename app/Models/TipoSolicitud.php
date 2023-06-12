<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoSolicitud extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rrhh.tipo_permiso_detalle';
    protected $fillable = ['tipo_permiso_id', 'descripcion', 'goce', 'sustento'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function tipo_permiso()
    {
        return $this->belongsTo(TipoPermiso::class);
    }
}
