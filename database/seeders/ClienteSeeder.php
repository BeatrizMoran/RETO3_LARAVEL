<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clientes = [
            [
                'codigo_cliente' => Crypt::encrypt('KILLER-123456'),
                'nombre' => 'Esteban',
                'email' => 'esteban@email.com',
                'direccion' => '123 Calle Principal',
                'telefono' => '677879856',
            ],
            [
                'codigo_cliente' => Crypt::encrypt('KILLER-234567'),
                'nombre' => 'Emilio',
                'email' => 'emilio@email.com',
                'direccion' => '456 Avenida Secundaria',
                'telefono' => '677876456',
            ],
            [
                'codigo_cliente' => Crypt::encrypt('KILLER-234567'),
                'nombre' => 'Antonio',
                'email' => 'antonio@email.com',
                'direccion' => 'Portal arriaga 13',
                'telefono' => '677875645',
            ],
            [
                'codigo_cliente' => Crypt::encrypt('KILLER-234567'),
                'nombre' => 'Amancio',
                'email' => 'amancio@email.com',
                'direccion' => 'Portal de legutiano 11',
                'telefono' => '677898096',
            ],
            [
                'codigo_cliente' => Crypt::encrypt('KILLER-234567'),
                'nombre' => 'Juan',
                'email' => 'juan@email.com',
                'direccion' => 'Arroitia 24',
                'telefono' => '655456554',
            ]
        ];

        foreach ($clientes as $cliente) {
            DB::table('clientes')->insert($cliente);
        }
    }
}
