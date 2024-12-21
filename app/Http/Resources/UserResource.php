<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'Nombre' => $this->name,
            'Apellidos' => $this->last_name,
            'Email' => $this->email,
            'Teléfono' => $this->phone,
            'Fecha de creación' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'Última actualización' => Carbon::parse($this->created_at)->format("d-m-Y h:m:s"),
            'Rol' => new RoleResource($this->whenLoaded('role')),
            'Comentarios' => CommentResource::collection($this->whenLoaded('comments')),

        ];
    }
    
}
