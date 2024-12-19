<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
        $mediaPuntuacion = $this->countScore > 0
            ? number_format($this->totalScore / $this->countScore, 2)
            : 0;

        return [
            'Id' => $this->id,
            'Name' => $this->name,
            'Registration Number' => $this->regNumber,
            'Observació' => $this->observation_CA,
            'Observación' => $this->observation_ES,
            'Observation' => $this->observation_EN,
            'Telephone' => $this->phone,
            'Email' => $this->email,
            'Web' => $this->website,
            'Accessibility' => $this->accessType,
            'Score' => $mediaPuntuacion,
            'Space Type' => new SpaceTypeResource($this->whenLoaded('spaceType')),
            'Address' => new AddressResource($this->whenLoaded('address')),
            'Modalities' => ModalityResource::collection($this->whenLoaded('modalities')),
            'Services' => ServiceResource::collection($this->whenLoaded('services')),
            'Comments' => CommentResource::collection($this->whenLoaded('comments')),
            'User Id' => $this->user_id
        ];
    }
}
