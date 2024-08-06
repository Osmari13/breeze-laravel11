<?php

namespace App\Listeners;

use App\Events\StoreCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreatTenantDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(StoreCreated $event): void
    {
        $tenant = $event->tenant;
        $db = "{$tenant->id}_tenant";
        $old = Config::get('database.connections.mysql.database');
        Config::set('database.connections.mysql', $db);
        DB::statement("CREATE DATABASE `$db`");
        Artisan::call('migrate:fresh', [
            '--path' => 'database/migrations/tenants',
            '--force' => true
        ]);
        Config::set('database.connections.mysql', $old);
    }
}
