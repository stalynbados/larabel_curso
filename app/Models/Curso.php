<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    
    use HasFactory;
    protected $fillable=[
        'curso_nombre',
        'curso_descripcion',
        'curso_estado',
        'id'
    
    ];
    public $timestamps = false;
    protected $table='curso'; //esta fila es para referenciar la tabla en la base de datos//
}
