<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Curso extends JsonResource
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
            'id' => $this->id,
            'curso_nombre' => $this->curso_nombre,
            'curso_descripcion' => $this->curso_descripcion,
            'curso_estado' => $this->curso_estado,
           
        ];
    }
}