<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Command
{
    protected $signature = 'create:admin';
    protected $description = 'Crea un usuario administrador si no existe';

    public function handle()
    {
        // Reemplaza 'admin@example.com' y 'password' con variables de entorno o un mecanismo seguro
        $email = env('ADMIN_EMAIL', 'jjamaica19@gmail.com');
        $password = env('ADMIN_PASSWORD', '12345678');

        if (User::where('email', $email)->exists()) {
            $this->info('El usuario administrador ya existe.');
            return;
        }

        $admin = User::create([
            'name' => 'Javier',
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $adminRole = Role::where('name', 'responsable')->first();
        $admin->assignRole($adminRole);

        $this->info('Usuario administrador creado exitosamente.');
    }
}
