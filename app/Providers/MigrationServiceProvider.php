<?php

namespace App\Providers;

use Illuminate\Database\Migrations\Migrator;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(Migrator::class, function ($app) {
            $migrator = new Migrator($app['migration.repository'], $app['db'], $app['files']);
            $migrator->setConnection(null);
            $migrator->setOutput($app['migrator.output']);
            $migrator->path(database_path('migrations/'.tenant('id').'/'));
            return $migrator;
        });
    }
}