<?php

namespace App\Listeners;

use App\Events\SaleCreated;
use App\Models\Sale;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTotalWhenSaleCreated
{

    /**
     * Handle the event.
     */
    public function handle(SaleCreated $event): void
    {
        $sale = Sale::find($event->saleId);

        $sale->updateTotal();

        logger("Cheguei no listener", [$event->saleId]);
    }
}
