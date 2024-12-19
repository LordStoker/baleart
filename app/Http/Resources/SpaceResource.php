<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\CommentResource;

use App\Http\Resources\ServiceResource;
use App\Http\Resources\ModalityResource;
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
            'Dirección' => $this->whenLoaded('address', function () {
                return implode(' - ', array_filter([
                    $this->address->name ?? null,
                    $this->address->municipality->name ?? null,
                    $this->address->zone->name ?? null,
                    $this->address->municipality->island->name ?? null,
                ]));
            }),
            'Tipo de espacio' => $this->space_type->name,
            'Fecha de creación' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'Última actualización' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'Usuario Gestor' => new UserResource($this->whenLoaded('user')),
            'Modalidades' => ModalityResource::collection($this->whenLoaded('modalities')),
            'Servicios' => ServiceResource::collection($this->whenLoaded('services')),            
            'Comentarios' => CommentResource::collection($this->whenLoaded('comments')),

        ];
    }
}
