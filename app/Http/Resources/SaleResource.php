<?php

namespace App\Http\Resources;

use App\Enums\NameResource;
use App\Models\ItemSale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class SaleResource extends JsonResource
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
            'type' => NameResource::SALE,
            'attributes' => [
                'total' => number_format($this->total, 2, ',', '.'),
                'created_at' => $this->created_at?->format('d-m-Y H:i:s'),
                'updated_at' => $this->updated_at?->format('d-m-Y H:i:s'),
            ],
            "relationships" => [
                NameResource::SELLER => [
                    'data' => [
                        'type' => NameResource::SELLER,
                        'id' => $this->user_id,
                    ]
                ],
                NameResource::CLIENT => [
                    'data' => [
                        'type' => NameResource::CLIENT,
                        'id' => $this->client_id,
                    ]
                ],
                NameResource::ITEM_SALE => $this->items
                    ->map(fn(ItemSale $item) => [
                        'data' => [
                            'type' => NameResource::ITEM_SALE,
                            'id' => $item->id,
                        ]
                    ]),
            ]
        ];
    }

    public function with(Request $request): array
    {
        $requestIncludeds = $request->input('included');
        $requestIncludeds = explode(',', $requestIncludeds);
        $requestIncludeds = array_flip($requestIncludeds);
        $included = [];

        if (Arr::has($requestIncludeds, NameResource::SELLER)) {
            $included[] = new UserResource($this->seller);
        }

        if (Arr::has($requestIncludeds, NameResource::CLIENT)) {
            $included[] = new UserResource($this->client);
        }

        if (Arr::has($requestIncludeds, NameResource::ITEM_SALE)) {
            $included = array_merge(
                $included,
                ItemSaleResource::collection($this->items)->toArray($request)
            );
        }

        return [
            'included' => $included,
        ];
    }
}
