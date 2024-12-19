<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'URL' => $this->url,
            'Comment' => $this->comment_id,
            'Created At' => $this->created_at,
            'Updated At' => $this->updated_at
        ];
    }
}
