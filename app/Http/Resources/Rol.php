<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Rol extends JsonResource
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
            'rol_id' => $this->rol_id,
            'rol_descripcion' => $this->rol_descripcion,
            'rol_estado' => $this->rol_estado,
           
        ];
    }
}