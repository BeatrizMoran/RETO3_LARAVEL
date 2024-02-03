<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Producto::factory(30)->create();

        // Cliente::factory(10)->create();

       /*  Cliente::factory(10)->create();
        Producto::factory(30)->create(); */

        $this->call([

            RoleSeeder::class,
            UserSeeder::class,
         /*    CategoriaSeeder::class,
            ProductoCategoriaSeeder::class, */
            //ProductoSeeder::class,
            // Producto::factory(30)->create()



        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
