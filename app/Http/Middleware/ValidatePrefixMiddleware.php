<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ValidatePrefixMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $prefix = $request->route()->getPrefix();
     
        $exists = DB::select("SELECT name FROM dblaravel11.companies WHERE name = ?", [$prefix[1]]);
        
        if (!$exists) {
            return abort(404, 'Company not found');
        }

        return $next($request);
    }
}
