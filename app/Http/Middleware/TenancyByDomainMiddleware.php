<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Database\Models\Domain;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Symfony\Component\HttpFoundation\Response;

class TenancyByDomainMiddleware extends InitializeTenancyByDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

        // $tenant = tenant('id');
        // //Domain::where('domain', $request->getHost())->first();
       
        // if (!$tenant) {
        //     return 'tenant.notfound';
        // }

        // $tenantRoutesPath  = base_path("routes/{$tenant}/routes.php");

        // if (File::exists($tenantRoutesPath)) {
        //     Route::middleware('api')->group($tenantRoutesPath);
        

        // } else {
        //     // Optionally handle the case where the routes file does not exist
        //     abort(404, 'Tenant routes file not found.');
        // }

        $host = $request->getHost();
        $store = Domain::where('domain', $host)->firstOrFail();
        App::instance('store.active', $store);

      
       
        // Llamar al método handle del padre para inicializar el tenant
        return parent::handle($request, $next);
    }
}
