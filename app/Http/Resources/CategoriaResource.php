<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'icono' => $this->icono,
            'id_nombre' => $this->id . '_' . $this->nombre // es posible definir propiedades combinadas
        ];
    }
}
