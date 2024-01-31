<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "codigo_referencia" => $this->codigo_referencia,
            "nombre" => $this->nombre,
            "precio" => $this->precio,
            "imagen" => $this->imagen,
            "formato" => $this->formato,
            "created_at" => $this->created_at,
            "categorias" => $this->categorias->pluck('nombre'), // Pluck extrae un array con los valores de la propiedad 'nombre'
        ];
    }
}
