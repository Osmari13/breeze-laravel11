<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Article;
use App\Models\Inventario;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function createInventario($inventarioId)
    {
        $dispatch_exist = Inventario::findOrFail($inventarioId);
        $inventario = new Inventario;
        $inventario->fill($dispatch_exist->toArray());
        $inventario->save();
        return $inventario->id;
    }
    public function store(Request $request)
    {
        
        return Helper::transactional(function () use ($request) {
            $inventarioIds = [];
            $newInventarios = [];
    
            foreach ($request->inventario as $value) {
                $inventarioId = Article::where('id', $value['article_id'])
                                       ->value('inventario_id');
    
                if (!isset($inventarioIds[$inventarioId])) {
                    $inventarioIds[$inventarioId] = [];
                    $newInventarios[] = $this->createInventario($inventarioId);
                }
               
                $inventarioIds[$inventarioId][] = $value['article_id'];
            }

            $index = 0;
            // Actualizar los artículos con los nuevos inventario_id
            foreach ($inventarioIds as  $articleIds) {
                
                Article::whereIn('id', $articleIds)
                ->update(['inventario_id' => $newInventarios[$index]]);
                $index += 1;
            }
            
            return Helper::jsonResponse(data: ['inventario' => $newInventarios]);
        });
    }

    // public function store(Request $request)
    // {
    //     return Helper::transactional(function () use ($request) {
    //         // Agrupar artículos por inventario_id
    //         $groupedArticles = [];
            
    //         foreach ($request->inventario as $value) {
    //             $inventario_id = Article::where('id', $value['article_id'])
    //                 ->select('inventario_id')
    //                 ->first()
    //                 ->inventario_id;

    //             // Agrupar por inventario_id
    //             if (!isset($groupedArticles[$inventario_id])) {
    //                 $groupedArticles[$inventario_id] = [];
    //             }
    //             $groupedArticles[$inventario_id][] = $value['article_id'];
    //         }

    //         // Crear nuevos registros de inventario y actualizar artículos
    //         $newInventarios = [];
            
    //         foreach ($groupedArticles as $inventario_id => $articleIds) {
    //             // Verificar si ya existe un inventario
    //             $dispatch_exist = Inventario::find($inventario_id);
                
    //             if (!$dispatch_exist) {
    //                 // Crear un nuevo registro en Inventario
    //                 $dispatch_exist = new Inventario();
    //                 // Aquí debes definir cómo llenar los campos del nuevo inventario
    //                 // Por ejemplo:
    //                 $dispatch_exist->nombre = "Nuevo Inventario"; // Cambiar según lógica
    //                 $dispatch_exist->descripcion = "Descripción del nuevo inventario"; // Cambiar según lógica
    //                 $dispatch_exist->cantidad = 0; // Cambiar según lógica
    //                 $dispatch_exist->precio = 0; // Cambiar según lógica
    //                 $dispatch_exist->save();
                    
    //                 // Guardar el nuevo inventario id
    //                 $newInventarios[$inventario_id] = $dispatch_exist->id;
    //             } else {
    //                 // Si ya existe, simplemente guardar su id
    //                 $newInventarios[$inventario_id] = $dispatch_exist->id;
    //             }

    //             // Actualizar los artículos con el nuevo inventario id
    //             Article::whereIn('id', $articleIds)->update(['inventario_id' => (int)$newInventarios[$inventario_id]]);
    //         }

    //         return Helper::jsonResponse(data: ['inventarios' => array_values($newInventarios)]);
    //     });
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
