<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Employee;
use App\Models\Tenant;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        return Helper::transactional(function () use ($request) {
            $tenant = Tenant::find(tenant('id'));
            if ($tenant) {
                // Cambiar el contexto al inquilino actual
                // Aquí puedes usar el contexto de multi-tenancy si es necesario
            
               
                $employee=Employee::create([
                    'name' => $request->name,
                    'cargo' => $request->cargo,
                    'departamento' => $request->departamento,
                    'user_id' => $request->user_id 
                ]);
            } else {
              
                return response()->json(['error' => 'Tenant not found'], 404);
            }
            return Helper::jsonResponse(data: ['data' => ['tenant' => $employee]]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
