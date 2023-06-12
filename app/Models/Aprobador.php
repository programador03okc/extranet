<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aprobador extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rrhh.aprobadores';
    protected $fillable = ['id_usuario'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
