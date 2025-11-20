<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->whenLoaded('userRelated', [
            'id'                => $this->userRelated->id,
            'name'              => $this->userRelated->name,
            'nickname'          => $this->userRelated->nickname,
            'birthdate'         => $this->userRelated->birthdate,
            'email'             => $this->userRelated->email,
            'image'             => $this->userRelated->image,
            'created_at'        => $this->userRelated->created_at,
            'updated_at'        => $this->userRelated->updated_at,
        ]);
    }
}
