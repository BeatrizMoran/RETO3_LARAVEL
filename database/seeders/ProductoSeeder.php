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
    public function run()
    {
        // Array de imágenes almacenadas en storage/public/images
        $imagenes = [
            '1.png',
            '2.png',
            '3.png',
            '4.png',
            '5.png',
            '6.png',
            '7.png',
            '8.png',
            '9.png',
            '10.png',
            '11.png',
            '12.png',
            '13.png',
            '14.png',
            '15.png',
            '16.png',
            '17.png',
            '18.png',
            '19.png',
            '20.png',
            '21.png',
            '12.png',
            '23.png',
            '24.png',
            '25.png',
            '26.png',
            '27.png',
            '28.png',
            '29.png',
            '30.png',
            // Agrega aquí el nombre de tus imágenes adicionales
        ];

        $nombres = [
            "Cors light limon",
            "Bud light limon",
            "Cruzcampo",
            "Maho 00",
            "Cruzcampo limon",
            "Corona extra limon",
            "Curzcampo doble malta",
            "Cruzcampo 00",
            "Bud light 00",
            "Guiness",
            "Miller lite",
            "Maho limon",
            "Guiness naranja",
            "Guiness limon",
            "Skol limon",
            "Brahma limon",
            "Becks",
            "Bud light doble malta",
            "Corona extra de la caasa",
            "Brahma azul original",
            "Guiness 00",
            "Corona extra",
            "Amstel",
            "Estrella galicia",
            "Heinneken",
            "Mahou",
            "Heinneken limon",
            "Mahou los origenes",
            "Skol origenes",
            "Estrella galicia origen",
            "Snows limon",
            // Agrega aquí el nombre de tus imágenes adicionales
        ];

        // Loop para generar 30 registros de productos
         for ($i = 0; $i < 30; $i++) {
            $nombreIndex = array_rand($nombres);
            $imagenIndex = array_rand($imagenes);

            DB::table('productos')->insert([
                'nombre' => $nombres[$nombreIndex],
                'codigo_referencia' => 'PROD-' . uniqid(),
                'precio' => rand(10, 100), // Precio aleatorio entre 10 y 100
                'imagen' => 'public/images/' . $imagenes[$imagenIndex], // Imagen aleatoria del array
                'formato' => ['20CL', '25CL', '33CL', '1L', 'Barril'][rand(0, 4)], // Formato aleatorio
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Eliminar nombre e imagen seleccionados del array
            array_splice($nombres, $nombreIndex, 1);
            array_splice($imagenes, $imagenIndex, 1);
        }
    }
}
