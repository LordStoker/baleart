<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IslandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return[
            'Identificador' => $this->id,
            'Isla' => $this->name,
            'Fecha de creación' => $this->created_at->format('Y-m-d H:i:s'),
            'Última actualización' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
