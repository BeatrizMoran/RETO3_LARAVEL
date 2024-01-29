<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'bea',
            'email' => 'bea@email.com',
            'password' => Hash::make('12345678')
        ]);

        $adminRole = Role::where('name', 'responsable')->first();
        $admin->assignRole($adminRole);

        $admin = User::create([
            'name' => 'javier',
            'email' => 'javier@email.com',
            'password' => Hash::make('12345678')
        ]);
        
        $adminRole = Role::where('name', 'administrativo')->first();
        $admin->assignRole($adminRole);

        $admin = User::create([
            'name' => 'ander',
            'email' => 'ander@email.com',
            'password' => Hash::make('12345678')
        ]);

        $adminRole = Role::where('name', 'comercial')->first();
        $admin->assignRole($adminRole);
    }
}
