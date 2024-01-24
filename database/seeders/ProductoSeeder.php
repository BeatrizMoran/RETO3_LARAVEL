<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('productos')->insert([
            'codigo_referencia' => 'PR001',
            'nombre' => 'Producto 1',
            'precio' => 15.99,
            'imagen' => 'ruta/imagen_producto1.jpg',
            'formato' => '33CL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'codigo_referencia' => 'PR002',
            'nombre' => 'Producto 2',
            'precio' => 12.50,
            'imagen' => 'ruta/imagen_producto2.jpg',
            'formato' => '25CL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('productos')->insert([
            'codigo_referencia' => 'PR003',
            'nombre' => 'Producto 3',
            'precio' => 20.75,
            'imagen' => 'ruta/imagen_producto3.jpg',
            'formato' => '1L',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
