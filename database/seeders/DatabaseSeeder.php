<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'user' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(30)->create();
        \App\Models\Provider::factory(10)->create();
        \App\Models\Customer::factory(5)->create();

        \App\Models\ItemStatus::factory()->create([
            'nombre_status' => 'Pendiente'
        ]);

        \App\Models\ItemStatus::factory()->create([
            'nombre_status' => 'Recibido'
        ]);
    }
}
