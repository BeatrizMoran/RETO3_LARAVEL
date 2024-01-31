<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "total" => $this->total,
            "fecha_pedido" => $this->created_at->format('d/m/Y'),
            "estado" => $this->estado,
            'productos' => $this->productos->map(function ($producto) {
                return [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'cantidad' => $producto->pivot->cantidad,
                    "imagen" => $producto->imagen,
                    "precio" => $producto->precio
                ];
            }),
        ];
    }
}
