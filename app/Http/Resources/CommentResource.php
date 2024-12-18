<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'Comentario' => $this->comment,
            'Usuario' => $this->user->name,
            'Espacio' => $this->space->name,
            'Puntuación' => $this->score,
            'Status' => $this->status,
            'Id de usuario' => $this->user_id,
            'Id de espacio' => $this->space_id,
            'Fecha de creación' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'Última actualización' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'Imágenes'=> ImageResource::collection($this->whenLoaded('images')),

        ];
    }
}
