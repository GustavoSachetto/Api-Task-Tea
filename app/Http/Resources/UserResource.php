<?php

namespace App\Http\Resources;

use App\Utils\ValidatorCPF\CPF;
use App\Utils\ValidatorPhone\Phone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the user into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'nickname'      => $this->nickname,
            'birthdate'     => $this->birthdate,
            'image'         => $this->image ? url($this->image) : null,            
            'banner'        => $this->banner ? url($this->banner) : null,            
            $this->mergeWhen($this->hasRole('responsible'), [
                'cpf'          => isset($this->advancedAccess->cpf) ? (new CPF($this->advancedAccess->cpf))->format() : null,
                'phone_number' => isset($this->advancedAccess->phone_number) ? (new Phone($this->advancedAccess->phone_number))->format() : null,
            ]),
            'role'          => $this->getRoleNames(),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}
