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

       /*  Cliente::factory(5)->create();
        Producto::factory(30)->create(); */

        $this->call([

            RoleSeeder::class,
            UserSeeder::class,
            ClienteSeeder::class

          /*   CategoriaSeeder::class,
            ProductoCategoriaSeeder::class, */

        ]);
    }
}
