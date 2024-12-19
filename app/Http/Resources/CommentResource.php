<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        return [
            'Id' => $this->id,
            'Comment' => $this->comment,
            'Score' => $this->score,
            'Status' => $this->status,
            'User Id' => $this->user_id,
            'Space Id' => $this->space_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
