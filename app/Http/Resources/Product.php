<?php
// recuperamos o extraemos los registros de la tabla product
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource //vamos a enviar puro archivos json
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) //comovertimos en una lista(array es una lista)
    {
        return [//entonces esta fila nos devuelve los datos o registro de nuestra table
            'id' => $this->id,
            'name' => $this->name,
            'detail' => $this->detail,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
