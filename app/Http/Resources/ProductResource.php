<?php

namespace App\Http\Resources;

use App\Enums\NameResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    //public $wrap = true;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => NameResource::PRODUCT,
            'attributes' => [
                'name' => $this->name,
                'value' => number_format($this->value, 2, ',', '.'),
                'created_at' => $this->created_at?->format('d-m-Y H:i:s'),
                'updated_at' => $this->updated_at?->format('d-m-Y H:i:s'),
            ]
        ];
    }
}
