<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'configuracion.sis_grupo';
    protected $primaryKey = 'id_grupo';
    public $timestamps = false;
}
