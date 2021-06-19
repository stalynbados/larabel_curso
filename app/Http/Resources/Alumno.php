<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Alumno extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'alumno_id' => $this->alumno_id,
            'user_id' => $this->user_id,
            'alumno_cod_alumno' => $this->alumno_cod_alumno,
            'alumno_direccion' => $this->alumno_direccion,
            
        ];
    }
}