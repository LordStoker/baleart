<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\ZoneResource;
use App\Http\Resources\MunicipalityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return[
            'Identificador' => $this->id,
            'Domicilio' => $this->name,
            'Zona' => new ZoneResource($this->whenLoaded('zone')),
            'Municipio' => new MunicipalityResource($this->whenLoaded('municipality')),
            'Fecha de creación' => $this->created_at->format('Y-m-d H:i:s'),
            'Última actualización' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
