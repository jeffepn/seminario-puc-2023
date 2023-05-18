<?php

namespace App\Providers;

use App\Events\SaleCreated;
use App\Listeners\UpdateTotalWhenSaleCreated;
use App\Models\ItemSale;
use App\Models\Sale;
use App\Models\User;
use App\Observers\ItemSaleObserver;
use App\Observers\SaleObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SaleCreated::class => [
            UpdateTotalWhenSaleCreated::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Sale::observe(SaleObserver::class);
        ItemSale::observe(ItemSaleObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
