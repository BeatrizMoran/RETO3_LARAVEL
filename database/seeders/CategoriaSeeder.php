<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categorias = [
            'Lager',
            'Ale',
            'IPA (Indian Pale Ale)',
            'Stout',
            'Porter',
            'Pilsner',
            'Wheat Beer',
            'Saison',
            'Sour',
            'Amber Ale',
            'Brown Ale',
            'Belgian Dubbel',
            'Belgian Tripel',
            'Belgian Quadrupel',
            'Barleywine',
            'Pale Ale',
            'Bock',
            'Blonde Ale',
            'Cream Ale',
        ];

        // Inserta las categorías en la base de datos
        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'nombre' => $categoria
            ]);
        }


    }
}
