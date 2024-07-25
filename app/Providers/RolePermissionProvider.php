<?php

namespace App\Providers;

use App\Interface\PermissionInterface;
use App\Interface\RoleInterface;
use App\Repository\PermissionRepository;
use App\Repository\RoleRepository;
use Illuminate\Support\ServiceProvider;

class RolePermissionProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
