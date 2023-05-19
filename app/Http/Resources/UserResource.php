<?php

namespace App\Http\Resources;

use App\Enums\TypeUser;
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
            'id' => $this->id,
            'type' => TypeUser::getNameResourceUser($this->type),
            'attributes' => [
                'type' => $this->type,
                'name' => $this->name,
                'email' => $this->email,
                'email_verified_at' => $this->email_verified_at?->format('d-m-Y H:i:s'),
                'created_at' => $this->created_at?->format('d-m-Y H:i:s'),
                'updated_at' => $this->updated_at?->format('d-m-Y H:i:s'),
            ]
        ];
    }
}
