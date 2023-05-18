<?php

namespace App\Observers;

use App\Models\ItemSale;

class ItemSaleObserver
{
    public function creating(ItemSale $itemSale)
    {
        # o total é igual ao amount x value do Product
        $itemSale->total = $itemSale->amount * $itemSale->product->value;
    }
}
