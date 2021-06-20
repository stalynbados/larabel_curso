<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anio_lectivo extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable=[
        'anio_lectivo_inicio',
        'anio_lectivo_fin',
        'anio_lectivo_estado'
    
    ];
    protected $table='anio_lectivo';
    public $timestamps = false;
}
