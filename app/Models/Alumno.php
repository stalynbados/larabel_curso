<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'alumno_cod_alumno',
        'alumno_direccion'
    
    ];
    protected $table='alumnno';
}
