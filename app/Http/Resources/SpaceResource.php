<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        //return parent::toArray($request);
        return [
            'Identificador' => $this->id,
            'Nombre' => $this->name,
            'Nº Registro' => $this->regNumber,
            'Detalles_CA' => $this->observation_CA,
            'Detalles_ES' => $this->observation_ES,
            'Detalles_EN' => $this->observation_EN,
            'Email' => $this->email,
            'Teléfono' => $this->phone,
            'Web' => $this->website,
            'Acceso para minusválidos' => ($this->accessType === "y" ? "Disponible" : ($this->accessType === "n" ? "No disponible" : "Parcialmente")),
            'Puntuación total' => $this->totalScore,
            'Nº de votaciones' => $this->countScore,
            'Dirección' => new AddressResource($this->whenLoaded('address')),
            // 'Tipo de espacio' => $this->space_type->name,
            'Usuario Gestor' => new UserResource($this->whenLoaded('user')),
            'Fecha de creación' => $this->created_at->format('Y-m-d H:i:s'),
            'Última actualización' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
