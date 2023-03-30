<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        Permission::create(['name' => 'eliminar ventas']);
        Permission::create(['name' => 'crear fiados']);
        Permission::create(['name' => 'eliminar pedidos']);

        Permission::create(['name' => 'eliminar productos']);
        Permission::create(['name' => 'acciones categorias']);

        Permission::create(['name' => 'agregar usuarios']);

        // Crear Roles
        $role = Role::create(['name' => 'Administrador'])
                        ->givePermissionTo([
                            'eliminar ventas', 
                            'crear fiados',
                            'eliminar pedidos',
                            'eliminar productos',
                            'acciones categorias',
                            'agregar usuarios'
                        ]);
        // $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Operario']);

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'user' => 'admin',
            'password' => Hash::make('admin'),
        ])->assignRole('Administrador');

        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(30)->create();
        \App\Models\Provider::factory(10)->create();
        \App\Models\Customer::factory(5)->create();

        \App\Models\ItemStatus::create([
            'nombre_status' => 'Pendiente'
        ]);

        \App\Models\ItemStatus::create([
            'nombre_status' => 'Recibido'
        ]);

    }
}
