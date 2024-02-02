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

         // Genera relaciones aleatorias con IDs existentes
         for ($i = 0; $i < 25; $i++) {
             $relaciones[] = [
                 'producto_id' => $this->getRandomId($productosIds),
                 'categoria_id' => $this->getRandomId($categoriasIds),
                 'created_at' => now(),
                 'updated_at' => now(),
             ];
         }

         // Inserta las relaciones en la base de datos
         DB::table('productos_categorias')->insert($relaciones);
    }

    private function getRandomId(array $ids)
    {
        return $ids[array_rand($ids)];
    }

}
