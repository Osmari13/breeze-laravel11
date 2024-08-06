<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'username' => 'user',
            'email' => 'test@example.com',
            'company_id' => 10,
            'password' => '123456'
        ]);
        $this->call([
            InventarioSeeder::class
        ]);

        // $tenant1 = Tenant::query()->create(attributes:['id' => 'foo']);
        // $tenant1->domains()->create(attributes:['domain' => 'foo.localhost']);
        // $tenant2 = Tenant::create(['id' => 'bar']);
        // $tenant2->domains()->create(['domain' => 'bar.localhost']);
        // Tenant::where('id', 'foo')->each(function ($tenant1) {
        //     // Cambiar el contexto al inquilino actual
        //     $tenant1->run(function () {
        //         Employee::create([
        //             'name' => 'Test User',
        //             'cargo' => 'Programador',
        //             'departamento' => 'IT',
        //             'user_id' => 1 // Asegúrate de que este user_id exista
        //         ]);
        //     });
        // });
        
        // // Crear empleados para el segundo inquilino
        // Tenant::where('id','bar')->each(function ($tenant2) {
        //     // Cambiar el contexto al inquilino actual
        //     $tenant2->run(function () {
        //         Employee::create([
        //             'name' => 'x User',
        //             'cargo' => 'Programador',
        //             'departamento' => 'IT',
        //             'user_id' => 2 // Asegúrate de que este user_id exista
        //         ]);
        //     });
        // });
    }
}
