<?php

namespace App\Observers;

use App\Models\Sale;

class SaleObserver
{
    public function creating(Sale $sale)
    {
        $sale->total = 0;
    }
}
