<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        return [
            'Id' => $this->id,
            'Name' => $this->name,
            'Last Name' => $this->lastname,
            'Telephone' => $this->phone,
            'Email' => $this->email,
            'Email Verified At' => $this->email_verified_at,
            'Password' => $this->password,
            'Role Id' => ($this->role_id== 1) ? 'administrador' : (($this->role_id == 2) ? 'gestor': 'visitant'),
            'Remember Token' => $this->remember_token,
            'Spaces' => SpaceResource::collection($this->whenLoaded('spaces')),
            'Comments' => CommentResource::collection($this->whenLoaded('comments')),
            'Images' => ImageResource::collection($this->whenLoaded('images'))
        ];
    }
}
