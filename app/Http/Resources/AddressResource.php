<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        return [
            'Id' => $this->id,
            'Name' => $this->name,
            'Municipality' => new MunicipalityResource($this->whenLoaded('municipality')),
            'Zone' => new ZoneResource($this->whenLoaded('zone')),
        ];
    }
}
