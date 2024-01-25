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
        DB::table('productos_categorias')->insert([
            'producto_id' => 1,
            "categoria_id" => 1
        ]);
        DB::table('productos_categorias')->insert([
            'producto_id' => 1,
            "categoria_id" => 2
        ]);
    }

}
