<?php

namespace App\Http\Resources;

use App\Enums\NameResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSaleResource extends JsonResource
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
            'type' => NameResource::ITEM_SALE,
            'attributes' => [
                'amount' => $this->amount,
                'total' => number_format($this->total, 2, ',', '.'),
                'created_at' => $this->created_at?->format('d-m-Y H:i:s'),
                'updated_at' => $this->updated_at?->format('d-m-Y H:i:s'),
            ],
            "relationships" => [
                NameResource::PRODUCT => [
                    'data' => [
                        'type' => NameResource::PRODUCT,
                        'id' => $this->product_id,
                    ]
                ],
            ],
        ];
    }
}
