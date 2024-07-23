<?php

namespace Database\Seeders;

use App\Models\Inventario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Inventario::create([
            'nombre' => 'Telefono',
            'descripcion' => 'SAMSUNG',
            'cantidad' => '10',
            'precio' =>  '1000',
        ]);
        Inventario::create([
            'nombre' => 'Telefono',
            'descripcion' => 'IPHONE',
            'cantidad' => '15',
            'precio' =>  '1500',
        ]);
        Inventario::create([
            'nombre' => 'Telefono',
            'descripcion' => 'LG',
            'cantidad' => '20',
            'precio' =>  '500',
        ]);
    }
}
