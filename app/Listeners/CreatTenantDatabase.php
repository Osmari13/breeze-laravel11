<?php

namespace App\Listeners;

use App\Events\StoreCreated;
use DirectoryIterator;
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
        $db = "sigeac_{$tenant->id}_tenant";
        // $old = Config::get('database.connections.tenant.database');
        // Config::set('database.connections.tenant.database', $db);
        // DB::statement("CREATE DATABASE `{$db}`");
        $dir = new DirectoryIterator(database_path('database/migrations/tenants'));
        foreach ($dir as $file) {
           if($file->isFile())
           {
               Artisan::call('migrate', [
                   '--path' => $file->getPath(),
                   '--force' => true
               ]);

           }
        }
        // Config::set('database.connections.tenant.database', $old);
    }
}
