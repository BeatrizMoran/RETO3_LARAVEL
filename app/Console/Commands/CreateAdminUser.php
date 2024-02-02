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
        $admin = User::create([
            'name' => 'bea',
            'email' => 'bea@email.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $adminRole = Role::where('name', 'responsable')->first();
        $admin->assignRole($adminRole);

        $this->info('Usuario administrador creado exitosamente.');
    }
}
