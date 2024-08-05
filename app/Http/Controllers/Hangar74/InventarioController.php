<?php

namespace App\Http\Controllers\Hangar74;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['role:sadmin','permission:inventario.index|inventario.create', 'only' => ['index','store']]);
    // }
    public function index()
    {
        $user = auth()->user();
        // if ($user->hasPermissionTo('inventario.index'))
        // {
            $inventario = Inventario::all();

            return response()->json([
                'inventario' => $inventario,
                'status' => 'successful'
            ]);
       // }
        // else
        // {
        //     return response()->json(['message' => 'Sin permisos'], 403);
        // }
        
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('inventario.create'))
        {
            return Helper::transactional(function () use ($request) {
            
                $inventario = Inventario::create($request->all());
                return Helper::jsonResponse(data: ['inventario' => $inventario]);
            });
        }
        else
        {
            return response()->json(['message' => 'Sin permisos'], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $inventario = Inventario::findOrFail($id);
        return response()->json([
            'inventario' => $inventario,
            'status' => 'successful'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
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
