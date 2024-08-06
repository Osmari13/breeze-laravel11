<?php

use App\Providers\EventServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\MigrationServiceProvider::class,
    App\Providers\RolePermissionProvider::class,
    App\Providers\TenancyServiceProvider::class,
    EventServiceProvider::class,
];
