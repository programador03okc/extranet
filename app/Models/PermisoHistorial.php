<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermisoHistorial extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rrhh.permiso_historial';
    protected $fillable = ['id_permiso', 'id_usuario', 'descripcion'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['formato_fecha'];

    public function permiso()
    {
        return $this->belongsTo(Permiso::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario')->withTrashed();
    }

    public function getFormatoFechaAttribute()
    {
        return date('d/m/Y H:iA', strtotime($this->created_at));
    }
}
