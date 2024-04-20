<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;

    protected $table = 'usuarios';

    protected $primaryKey = 'usuario_id';

    protected $fillable = [
        'nombre',
        'apellido',
        'domicilio',
        'telefono',
        'email',
        'contenido'
    ];

}
