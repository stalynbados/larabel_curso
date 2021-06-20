<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Anio_lectivo extends JsonResource
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
            'anio_lectivo_inicio' => $this->anio_lectivo_inicio->format('d/m/Y'),
            'anio_lectivo_fin' => $this->anio_lectivo_fin->format('d/m/Y'),
            'anio_lectivo_estado' => $this->anio_lectivo_estado,
           
        ];
    }
}