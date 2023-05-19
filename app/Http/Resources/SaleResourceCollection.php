<?php

namespace App\Http\Resources;

use App\Enums\NameResource;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class SaleResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function with(Request $request): array
    {
        $requestIncludeds = $request->input('included');
        $requestIncludeds = explode(',', $requestIncludeds);
        $requestIncludeds = array_flip($requestIncludeds);
        $included = [];

        if (Arr::has($requestIncludeds, NameResource::SELLER)) {
            $included = array_merge(
                $included,
                $this->collection
                    ->map(fn(SaleResource $sale) => new UserResource($sale->seller))
                    ->unique()
                    ->toArray()
            );
        }

        if (Arr::has($requestIncludeds, NameResource::CLIENT)) {
            $included = array_merge(
                $included,
                $this->collection
                    ->map(fn(SaleResource $sale) => new UserResource($sale->client))
                    ->unique()
                    ->toArray()
            );
        }

        if (Arr::has($requestIncludeds, NameResource::ITEM_SALE)) {
            $this->collection->each(function (SaleResource $sale) use (&$included, $request) {
                $included = array_merge(
                    $included,
                    ItemSaleResource::collection($sale->items)->toArray($request)
                );

            });
        }

        return [
            'included' => $included
        ];
    }
}
