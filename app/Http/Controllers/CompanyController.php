<?php

namespace App\Http\Controllers;

use App\Events\StoreCreated;
use App\Helpers\Helper;
use App\Models\Company;
use App\Models\Tenant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        // return Helper::transactional(function () use ($request) {
        //     $tenant = Tenant::create(['id' => $request->tenant]);
        //     $tenant->domains()->create(['domain' => $tenant->id.'.'.'localhost']);
        //     // $company= Company::create([
        //     //     'name' => $request->company,
        //     //     'tenant_id' => $tenant->id
        //     // ]);
            
        //     return Helper::jsonResponse(data: ['data' => ['tenant' => $tenant]]);
        // });
        
        try {
          
            $tenant = Tenant::create(['id' => $request->tenant]);
            $tenant->domains()->create(['domain' => $tenant->id.'.'.'localhost']);
            $company= Company::create([
                'name' => $request->company,
                'tenant_id' => $tenant->id
            ]);
            $company->save();
            event(new Registered($tenant)); //event(new StoreCreated($tenant));
            return Helper::jsonResponse(data: ['tenant' => $tenant, 'company'=>$company]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Ocurrió un error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
