<?php

namespace App\Providers;

use App\Events\StoreCreated;
use App\Listeners\CreatTenantDatabase;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    protected $listen = [
        StoreCreated::class => [
            CreatTenantDatabase::class,
        ]
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
