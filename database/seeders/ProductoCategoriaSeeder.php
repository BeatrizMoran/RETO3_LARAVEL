<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtén todos los IDs de productos y categorías de la base de datos
        $productosIds = DB::table('productos')->pluck('id')->toArray();
        $categoriasIds = DB::table('categorias')->pluck('id')->toArray();

        // Relaciones entre productos y categorías
        $relaciones = [];

        // Asigna una categoría a cada producto de manera secuencial
        foreach ($productosIds as $productoId) {
            $categoriaId = array_shift($categoriasIds);

            // Asegúrate de que las categorías se reutilicen si se agotan
            if (empty($categoriasIds)) {
                $categoriasIds = DB::table('categorias')->pluck('id')->toArray();
            }

            $relaciones[] = [
                'producto_id' => $productoId,
                'categoria_id' => $categoriaId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Asigna categorías aleatorias a los productos restantes
        for ($i = count($productosIds); $i < 30; $i++) {
            $relaciones[] = [
                'producto_id' => rand(1, 30), // Puedes ajustar el rango si es necesario
                'categoria_id' => rand(1, 19), // Puedes ajustar el rango si es necesario
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Inserta las relaciones en la base de datos
        DB::table('productos_categorias')->insert($relaciones);
    }



}
